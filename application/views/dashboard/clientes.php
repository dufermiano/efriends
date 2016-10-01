<?php $this->load->view('dashboard/nav-admin')?>
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js')?>"></script>
<script src="<?php echo base_url('assets/dist/js/sb-admin-2.js')?>"></script>
<script src="<?php echo base_url('assets/js/main.js')?>"></script>
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
										<th>Username</th>
										<th>Nome do Cliente</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="corpo">
							</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
