
(function () {

    tinymce.create('tinymce.plugins.AcePlugin', {
        init: function (ed, url) {

            ed.addButton('aceeditor', {
                title: 'HTML Editor',
                cmd: 'mceAceEditor',
                image: url + '/img/code.png'
            });


            ed.addCommand('mceAceEditor', function(ed) {
                jQuery('#' + this.id).entwine('ss').openAceDialog(url);
            });

        },

        getInfo: function () {
            return {
                longname: 'Ace editor',
                author: 'Nathan Cox',
                authorurl: '',
                infourl: '',
                version: "1.0"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('aceeditor', tinymce.plugins.AcePlugin);
})();


(function($) {
  $.entwine('ss', function($) {
    $('textarea.htmleditor').entwine({


      openAceDialog: function(url) {

        var self = this;

        var $dialog = $('.htmleditorfield-acedialog');

        if($dialog.length) {

          var content = tinyMCE.activeEditor.getContent();
          var ed = $($('textarea.codeeditor', $dialog).first().getEditor().getSession().setValue(content));

        //  ed.val(content);

          $dialog.getForm().setElement(this);

          $dialog.open();
        } else {
          $dialog = $('<div class="htmleditorfield-dialog htmleditorfield-acedialog">');
          $('body').append($dialog);

          var url = 'TinyMCECodeEditor/PopupForm/forTemplate';

          $.ajax({
            url: url,
            complete: function() {
              $dialog.removeClass('loading');
            },
            success: function(html) {
              $dialog.html(html);
              var content = tinyMCE.activeEditor.getContent();
              var ed = $($('textarea.codeeditor', $dialog).first());

              ed.val(content);

              $dialog.getForm().setElement(self);
              $dialog.trigger('ssdialogopen');
            }
          });
        }
      }




    });



    $('form.htmleditorfield-codeform').entwine({
      // TODO Entwine doesn't respect submits triggered by ENTER key
      onsubmit: function(e) {
        this.saveChanges();
        this.getDialog().close();
        return false;
      },

      saveChanges: function() {
        
          $field = this.getCodeField();

        this.getEditor().setContent($field.getEditor().getSession().getValue());
      },

      getCodeField: function() {
        return $('textarea.codeeditor', this);
      }

    });


    $('form.htmleditorfield-codeform button[name=action_cancel]').entwine({
      onclick: function(e) {
        this.closest('form').getDialog().close();
        return false;
      }
    });



  });
})(jQuery);
