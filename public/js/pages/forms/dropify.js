$(function() {

    $('.dropify').dropify();

    var drEvent = $('#dropify-event').dropify({  messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remover',
            'error':   'Ooops, algum erro aconteceu.'
    }});

    drEvent.on('dropify.beforeClear', function(event, element) {
        return confirm("Você realmente quer deletar \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element) {
        alert('Arquivo deletado');
    });



    $('.dropify-fr').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, le fichier trop volumineux'
        }
    });
});