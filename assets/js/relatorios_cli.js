$( document ).ready(function(){
	pegaRelatoriosCli();
	pegaRelatoriosEbook();
});

function pegaRelatoriosCli(){
	$.ajax({
		url: "index.php/Cliente/relatorio_historico",
		type: "GET",
		data: "" ,
		dataType: 'json',
		success: function (data){
			$.each(data, function (i, item) {
				$('<tr>').append(         
						$('<td>').append(item.Data_Acao),
						$('<td>').append(item.Acao_Realizada),
						$('<td>').append(item.Campo_Alterado),
						$('<td>').append(item.Valor_Antigo),
						$('<td>').text(item.Valor_Novo)
				).appendTo('#corpoCliente');
			});
		}

	});
	
}

function pegaRelatoriosEbook(){
	$.ajax({
		url: "index.php/Cliente/relatorio_ebook",
		type: "GET",
		data: "" ,
		dataType: 'json',
		success: function (data){
			$.each(data, function (i, item) {
				$('<tr>').append(         
						$('<td>').append(item.idEbook),
						$('<td>').append(item.Titulo_Ebook),
						$('<td>').text(item.Data_Acao),
						$('<td>').text(item.Status_Cli_Ebook)
				).appendTo('#corpoLivro');
			});
		}

	});
	
}
 
