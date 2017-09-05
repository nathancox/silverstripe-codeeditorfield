tinymce.PluginManager.add('aceeditor', function(editor, url) {
    editor.addButton('aceeditor', {
        'tooltip': 'Edit HTML',
        'cmd': 'mceAceEditor',
        'icon': 'code'
    })

    editor.addCommand("mceAceEditor", function(ed) {
        console.log('mceAceEditor')
        jQuery('#' + this.id).entwine('ss').openAceDialog();
        //jQuery(`#${editor.id}`).entwine('ss').openEmbedDialog();

    })
})
