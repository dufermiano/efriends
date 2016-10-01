$( document ).ready(function(){
	$.ajax({
		url: "index.php/Cliente/lista_clientes",
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
			        $('<td>').append($('<input type=text readonly size=2 style="background: transparent; border: none;">').val(item.idCliente)),
			        $('<td>').text(item.Login_Cli),
			        $('<td>').text(item.Nome_Cli),
			        $('<td>').append($('<input type=text readonly size=10 style="background: transparent; border: none;">').val(sta)),
			        $('<a class="btn btn-success" id="status" href="index.php/Cliente/muda_status?cod='+item.idCliente+'&status='+sta+'">Alterar Status</a>')
			        ).appendTo('#corpo');
			    });
			}
	
		});
}); 

function filtra(valor){
	console.log("");
	if(valor == "Ativos"){
		$("#corpo").empty();
		$.ajax({
			url: "index.php/Cliente/lista_cli_ativo",
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
				        $('<td>').append($('<input type=text readonly size=2 style="background: transparent; border: none;">').val(item.idCliente)),
				        $('<td>').text(item.Login_Cli),
				        $('<td>').text(item.Nome_Cli),
				        $('<td>').append($('<input type=text readonly size=10 style="background: transparent; border: none;">').val(sta)),
				        $('<a class="btn btn-success" id="status" href="index.php/Cliente/muda_status?cod='+item.idCliente+'&status='+sta+'">Alterar Status</a>')
				        ).appendTo('#corpo');
				    });
				}

			});
		}
	else if(valor == "Inativos"){
		$("#corpo").empty();
		$.ajax({
			url: "index.php/Cliente/lista_cli_inativo",
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
				        $('<td>').append($('<input type=text readonly size=2 style="background: transparent; border: none;">').val(item.idCliente)),
				        $('<td>').text(item.Login_Cli),
				        $('<td>').text(item.Nome_Cli),
				        $('<td>').append($('<input type=text readonly size=10 style="background: transparent; border: none;">').val(sta)),
				        $('<a class="btn btn-success" id="status" href="index.php/Cliente/muda_status?cod='+item.idCliente+'&status='+sta+'">Alterar Status</a>')
				        ).appendTo('#corpo');
				    });
				}

			});
		}
	
	else{
		$("#corpo").empty();
		$.ajax({
			url: "index.php/Cliente/lista_clientes",
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
				        $('<td>').append($('<input type=text readonly size=2 style="background: transparent; border: none;">').val(item.idCliente)),
				        $('<td>').text(item.Login_Cli),
				        $('<td>').text(item.Nome_Cli),
				        $('<td>').append($('<input type=text readonly size=10 style="background: transparent; border: none;">').val(sta)),
				        $('<a class="btn btn-success" id="status" href="index.php/Cliente/muda_status?cod='+item.idCliente+'&status='+sta+'">Alterar Status</a>')
				        ).appendTo('#corpo');
				    });
				}
		
			});
	}
	}