$( document ).ready(function() {

	//$('.phone').mask('(99) 999-999999');

	$(".btn-search-trilha").click(function(){

		var cidade = $('select[name ="cidade"]').val();  
		var nivel  = $('select[name ="nivel"]').val();  
		var url    = '';
		var ancora = '#lista'

	 	if(cidade != '' && nivel != '')
	 		url = cidade+'/trilhas/'+nivel+ancora;

	 	if(cidade == '' && nivel == '')
	 		url = 'trilhas'+ancora;

	 	if(cidade != '' && nivel == '')
	 		url = cidade+'/trilhas'+ancora;

	 	if(cidade == '' && nivel != '')
	 		url = 'trilhas/'+nivel+ancora;

	 	window.location.href = window.location.protocol+'//'+window.location.hostname+'/'+url;
	});

});