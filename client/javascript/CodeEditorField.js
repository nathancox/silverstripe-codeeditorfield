(function($) {
    $.entwine('ss', function($) {
        $('textarea.codeeditor').entwine({
            Editor: false,

            onmatch: function(e) {
                var textarea = this

                // hide the textarea
                this.hide()

                // create the editor div
                var divID = this.attr('id') + '_Ace'
                var $div = this.getEditorEl()

                $div.insertAfter(this)
                ace.config.set('modePath', this.data('ace-path'))
                ace.config.set('workerPath', this.data('ace-path'))
                ace.config.set('themePath', this.data('ace-path'))

                // apply the editor to the div
                var editor = ace.edit(divID)

                // make the editor update the textarea content
                editor.getSession().setValue(textarea.val());
                editor.getSession().on('change', function() {
                    textarea.val(editor.getSession().getValue())
                    textarea.change()
                });

                editor.setAutoScrollEditorIntoView(false)
                editor.getSession().setTabSize(2)
                editor.setShowPrintMargin(false)
                editor.session.setWrapLimitRange(null, null)
                if (this.data('wrap') == 1) {
                    editor.session.setUseWrapMode(true);
                    this.getWordWrapEl().attr('checked', true);
                }

                // set the mode (ie syntax highlighting)
                editor.getSession().setMode('ace/mode/' + this.data('mode'))

                // load a theme if one is set
                if ($.cookie('codeeditorfield-theme')) {
                    editor.setTheme('ace/theme/' + $.cookie('codeeditorfield-theme'))
                } else if (this.data('theme')) {
                    editor.setTheme('ace/theme/' + this.data('theme'))
                }

                var lineHeight = (editor.renderer.lineHeight > 1 ? editor.renderer.lineHeight : 16)

                $div.css('min-height', lineHeight * textarea.attr('rows') + 35 + 'px')

                editor.resize(true)
                this.setEditor(editor)
                this.addClass('done')

                this._super(e)
            },

            getEditorEl: function() {
                return $('#' + this.attr('id') + '_Ace')
            },

            getWordWrapEl: function() {
                return $('#' + this.attr('id') + '_Ace_word_wrap')
            }
        });

        $('.codeeditor .ss-ui-button').entwine({
            onmouseup: function() {
                this.blur()
            },

            getEditor: function() {
                return $(this.closest('.middleColumn').find('textarea').first()).getEditor()
            }
        })

        // Word wrap toggle
        $('.codeeditor .ace-word-wrap-button input').entwine({
            onchange: function() {
                var editor = this.closest('.field').find('textarea').getEditor()

                if (editor.session.getUseWrapMode()) {
                    editor.session.setUseWrapMode(false)
                    this.parent().removeClass('active')
                } else {
                    editor.session.setUseWrapMode(true)
                    this.parent().addClass('active')
                }
                this.blur()
                //return false
            }
        })

        // Light/Dark toggle (only included if possible)
        $('.codeeditor .ace-theme-button').entwine({
            onclick: function() {
                var textArea = this.closest('.field').find('textarea').first()
                var editor = textArea.getEditor()

               var  theme = textArea.data('dark')
                if (editor.getTheme() === ('ace/theme/' + textArea.data('dark'))) {
                    theme = textArea.data('light')
                }

                editor.setTheme('ace/theme/' + theme)
                $.cookie('codeeditorfield-theme', theme)

                return false
            }
        })
    })

  $.entwine('ss', function($) {
    $('textarea.htmleditor').entwine({

        openAceDialog: function() {


            var dialog = $('.htmleditorfield-acedialog')

            if (!dialog.length) {
                dialog = $('<div class="htmleditorfield-acedialog" />')
                $('body').append(dialog)
            }

            dialog.setElement(this)
            dialog.open()

            console.log(dialog)









/*
        var self = this

        var $dialog = $('.htmleditorfield-acedialog')

        if ($dialog.length) {
          var content = tinyMCE.activeEditor.getContent()
          var ed = $($('textarea.codeeditor', $dialog).first().getEditor().getSession().setValue(content))

        //  ed.val(content);

          $dialog.getForm().setElement(this)

          $dialog.open()
        } else {
          $dialog = $('<div class="htmleditorfield-dialog htmleditorfield-acedialog">')
          $('body').append($dialog);

          var url = 'TinyMCECodeEditor/PopupForm/forTemplate'

          $.ajax({
            url: url,
            complete: function() {
              $dialog.removeClass('loading')
            },
            success: function(html) {
              $dialog.html(html)
              var content = tinyMCE.activeEditor.getContent()
              var ed = $($('textarea.codeeditor', $dialog).first())

              ed.val(content)

              $dialog.getForm().setElement(self)
              $dialog.trigger('ssdialogopen')
            }
          })
        }
        */
      }
    })



    $('form.htmleditorfield-codeform').entwine({
      // TODO Entwine doesn't respect submits triggered by ENTER key
      onsubmit: function(e) {
        this.saveChanges()
        this.getDialog().close()
        return false
      },

      saveChanges: function() {
          $field = this.getCodeField()

        this.getEditor().setContent($field.getEditor().getSession().getValue())
      },

      getCodeField: function() {
        return $('textarea.codeeditor', this)
      }
    })

    $('form.htmleditorfield-codeform button[name=action_cancel]').entwine({
      onclick: function(e) {
        this.closest('form').getDialog().close()
        return false
      }
    })

  })
})(jQuery)
