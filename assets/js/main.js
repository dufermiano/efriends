$( document ).ready(function(){
	getCliente("index.php/Cliente/lista_clientes");
}); 

function filtra(valor){
	if(valor == "Ativos"){
		var url = "index.php/Cliente/lista_cli_ativo";
		getCliente(url);
	}
	else if(valor == "Inativos"){
		var url = "index.php/Cliente/lista_cli_inativo";
		getCliente(url);
	}

	else{
		var url = "index.php/Cliente/lista_clientes";
		getCliente(url);
	}
}

function getCliente(url){
	$("#corpo").empty();
	var base = "obra_cli";
	$.ajax({
		url: url,
		type: "GET",
		data: "" ,
		dataType: 'json',
		success: function (data){
			$.each(data, function (i, item) {
				if(item.Status_Cli == true){
					var sta = "Ativo";
				}
				else{
					var sta = "Inativo";
				}
				$('<tr>').append(                 
						$('<td>').append(item.idCliente),
						$('<td>').text(item.Login_Cli),
						$('<td>').text(item.Nome_Cli),
						$('<td>').append(sta),
						$('<a class="btn btn-success" style="margin-left: 40px;" href="index.php/Cliente/muda_status?cod='+item.idCliente+'&status='+sta+'">Alterar Status</a>'),
						$('<a class="btn btn-primary" style="margin-left: 40px;" href="'+base+'?user='+item.Login_Cli+'">Ver Obras</a>')
				).appendTo('#corpo');
			});
		}

	});
}