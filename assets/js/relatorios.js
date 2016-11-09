$( document ).ready(function(){
	pegaRelatoriosAdmin();
	pegaRelatoriosEbook();
});

function pegaRelatoriosAdmin(){
	$.ajax({
		url: "index.php/Admin/relatorio_cliente",
		type: "GET",
		data: "" ,
		dataType: 'json',
		success: function (data){
			$.each(data, function (i, item) {
				$('<tr>').append(         
						$('<td>').append(item.idCliente),
						$('<td>').append(item.Nome_Cli),
						$('<td>').text(item.Data_Acao),
						$('<td>').text(item.Acao_Admin_Cli)
				).appendTo('#corpoCliente');
			});
		}

	});
	
}

function pegaRelatoriosEbook(){
	$.ajax({
		url: "index.php/Admin/relatorio_ebook",
		type: "GET",
		data: "" ,
		dataType: 'json',
		success: function (data){
			$.each(data, function (i, item) {
				$('<tr>').append(         
						$('<td>').append(item.idEbook),
						$('<td>').append(item.Titulo_Ebook),
						$('<td>').text(item.Data_Acao),
						$('<td>').text(item.Acao_Admin_Ebook)
				).appendTo('#corpoLivro');
			});
		}

	});
	
}
 
