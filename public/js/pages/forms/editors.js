$(function () {
    //CKEditor
    
    CKEDITOR.replace( 'ckeditor', {
        toolbarGroups: [
            { name: 'document',	   groups: [ 'mode', 'document' ] },			// Displays document group with its two subgroups.
             { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			// Group's name will be used to create voice label.
             '/',																// Line break - next group will be placed in new line.
             { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
             { name: 'links' },
             { name: 'colors', items: [ 'TextColor', 'BGColor' ] }
        ]
    
        // NOTE: Remember to leave 'toolbar' property with the default value (null).
    });
  
});