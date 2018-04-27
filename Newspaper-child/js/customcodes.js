(function() {
    tinymce.create('tinymce.plugins.video_mil24', {
        init : function(ed, url) {
            ed.addButton('video_mil24', {
                title : 'Aggiungi video',
                image : url+"/video_mil24.png",
                onclick : function() {
                     ed.selection.setContent('[video_mil24 url="" autoplay="true" width="100%" height="300" mute="false" repeat="false"]' + ed.selection.getContent());
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('video_mil24', tinymce.plugins.video_mil24);
})();