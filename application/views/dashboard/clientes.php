<?php $this->load->view('dashboard/nav-admin')?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Lista de Clientes</h1>
		</div>
		<div class="col-xs-3">
			<select class="form-control" style='margin-left: 60px;' id="busca" onchange="filtra(this.value);">
				<option>Todos</option>
				<option>Ativos</option>
				<option>Inativos</option>
			</select> 
		</div>
		<div class="col-lg-10 col-md-5">
			<div class="panel">
				<div class="panel-heading">
					<div class="row">
					<?php if($msg = get_msg()): echo '<div class="msg-box" style="margin-left: 60px;" >'.$msg.'</div>'; endif;?>  
					<div class="panel panel-primary" style='margin-left: 60px;'>
							<table id="main_table" class="table table-striped table-hover" style="">
								<thead>
									<tr>
										<th>Código do Cliente</th>
										<th>Nome do Cliente</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							<?php foreach ($clientes as $cli): ?>
							<form action="<?php echo base_url('index.php/Cliente/muda_status')?>" method="post">
										<tr>
											<td><input readonly size=3 id="id" type=text name='id' style="background: transparent; border: none;" value="<?php echo $cli->idCliente ?>"></td>
											<td><?php echo $cli->Nome_Cli ?></td>
											<td><input readonly size=10 type=text name='status' style="background: transparent; border: none;" value="<?php if($cli-> Status_Cli == true): echo "Ativo"; else: echo "Inativo"; endif; ?>"></td>
											<td><button class="btn btn-success" id="status">Alterar Status</button></td>
										</tr>
									</form>
							<?php endforeach; ?>
							</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script language="javascript" type="text/javascript">
		function filtra(valor){
			console.log("");
			if(valor == "Ativos"){
				$.ajax({
					url: "index.php/Cliente/lista_cli_ativo",
					type: "GET",
					data: "" ,
					dataType: 'json',
					success: function (response){

						for(i in response){
						console.log(response[i]['idCliente']);
						console.log(response[i]['Nome_Cli']);
						console.log(response[i]['Status_Cli']);
						}
						//var table = $(data).find("#main_table");
						//$('.panel-primary').html(table);

						}

					});
				}
			else if(valor == "Inativos"){
				$.ajax({
					
					url: "index.php/Cliente/lista_cli_inativo",
					data: "" ,
					dataType: 'json',
					success: function (response){

						for(i in response){
						console.log(response[i]['idCliente']);
						console.log(response[i]['Nome_Cli']);
						console.log(response[i]['Status_Cli']);
						}
						//var table = $(data).find("#main_table");
						//$('.panel-primary').html(table);

						}
								

					});
				}
			
		

		//}
			}
</script>
<script
	src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
<script
	src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<script
	src="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js')?>"></script>
<script src="<?php echo base_url('assets/dist/js/sb-admin-2.js')?>"></script>
</body>
</html>


