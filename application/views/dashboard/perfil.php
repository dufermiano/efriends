<?php
$this->load->view ( 'dashboard/nav-admin' );
foreach ( $admin as $row ) :
	?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Editar Perfil</h1>
		</div>
	</div>

	<script type="text/javascript">

		function trocaStatus(){

			var x = document.getElementById("statusSelect").value;
			document.getElementById("statusInput").value = x;
			}
	
    </script>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Informações de cadastro</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6">
						<?php if($msg = get_msg()): echo '<div class="msg-box">'.$msg.'</div>'; endif;?>
							<form role="form" action="<?php echo base_url('index.php/Admin/altera_admin')?>"
								method="post">
								<div class="form-group">
									<label>Login</label> <input class="form-control" type="text"
										value="<?php echo $row->Login_Admin ?>" name="login" readonly>
								</div>
								<div class="form-group">
									<label>Nome</label> <input class="form-control" type="text"
										value="<?php echo$row->Nome_Admin ?>" name="nome" required>
								</div>

								<div class="form-group">
									<label>Telefone</label> <input class="form-control"
										type="number" value="<?php echo$row->Telefone_Admin ?>"
										name="telefone" required>
								</div>
								<div class="form-group">
									<label>E-mail</label> <input class="form-control" type="email"
										value="<?php echo $row->Email_Admin ?>" name="email" required>
								</div>
								<div class="form-group">
									<label>Data de cadastro</label> <input class="form-control"
										type="text" value="<?php echo $row->Data_Cadastro ?>"
										name="data" readonly>
								</div>
										<?php endforeach;?>
                                        <div class="col-md-5"
									style="margin-bottom: 40px">
									<button type="submit" class="btn btn-primary btn-lg btn-block"
										style="margin-left: 80%">ATUALIZAR</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
</div>
</div>
<script
	src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
<script
	src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<script
	src="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js')?>"></script>
<script src="<?php echo base_url('assets/dist/js/sb-admin-2.js')?>"></script>
</body>
</html>
