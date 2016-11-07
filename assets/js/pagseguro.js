function enviaPagseguro(){

	var codigo = decodeURIComponent(new RegExp('[\?&]' + 'cod' + '=([^&#]*)').exec(window.location.href)[1]);

	$.ajax({
		  url: "index.php/Ebook/pagseguro/",
		  data: {cod : codigo},
		  type: 'post',
		  dataType: 'json',
	 	  success: function (data){
	 			$.each(data, function (i, item) {
	 				var dados = {'id': item.idEbook, 'titulo': item.Titulo_Ebook, 'valor': item.Preco_Ebook};
	 				console.log('dados: '+ dados);
	 				$.post('index.php/Pagseguro/geraPag',dados,function(data){
	 				$('#code').val(data);
	 				$('#comprar').submit();
	 				});
				});
		 }

	});
	
}

function mensagem(){
	alert("Para comprar, você precisa estar logado!");
}

function pegalink(){
	var codigo = decodeURIComponent(new RegExp('[\?&]' + 'cod' + '=([^&#]*)').exec(window.location.href)[1]);
	
	$.ajax({
		  url: "index.php/Ebook/pegalink/",
		  data: {cod : codigo},
		  type: 'post',
		  dataType: 'json',
	 	  success: function (data){
	 		  window.open(data[0].obra);
		 }

	});
	
	
}