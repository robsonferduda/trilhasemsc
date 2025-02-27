$( document ).ready(function() {

    $("#list-cidade").change(function(){

        var url = $(this).val();

        window.location.href = url;

    });
});