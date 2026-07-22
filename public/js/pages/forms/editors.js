$(function () {
    if (typeof CKEDITOR === 'undefined') {
        return;
    }

    // Desativa o Advanced Content Filter (ACF):
    // sem isso, o CKEditor remove tags/atributos que não estão na whitelist dele.
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.config.extraAllowedContent = '*(*);*{*}';
    CKEDITOR.config.pasteFilter = null;

    CKEDITOR.replace('ckeditor', {
        height: 320,
        language: 'pt-br',
        removePlugins: 'elementspath',
        // Mantém HTML livre: div, style, class, span, etc.
        allowedContent: true,
        extraAllowedContent: '*(*);*{*}',
        pasteFilter: null,
        // Toolbar enxuta + Source para colar/editar HTML livremente
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'clipboard', items: ['Undo', 'Redo'] },
            { name: 'document', items: ['Source'] }
        ],
        enterMode: CKEDITOR.ENTER_P,
        shiftEnterMode: CKEDITOR.ENTER_BR
    });
});
