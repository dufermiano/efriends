<?php
$this->load->view ( 'dashboard/nav-cli' );
foreach ( $cliente as $row ) :
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
				<div class="panel-heading">Informações de cadastro do cliente</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6">
						<?php if($msg = get_msg()): echo '<div class="msg-box">'.$msg.'</div>'; endif;?>
							<form role="form" action="<?php echo base_url('index.php/Cliente/altera_cliente')?>"
								method="post">
								<div class="form-group">
									<label>Login</label> <input class="form-control" type="text"
										value="<?php echo $row->Login_Cli ?>" name="login" readonly>
								</div>
								<div class="form-group">
									<label>Nome</label> <input class="form-control" type="text"
										value="<?php echo$row->Nome_Cli ?>" name="nome" required>
								</div>
								<div class="form-group">
									<label>CPF</label> <input readonly class="form-control"
										type="text" value="<?php echo $row->CPF_Cli ?>"
										name="cpf" required>
								</div>
								<div class="form-group">
									<label>Telefone</label> <input class="form-control"
										type="text" value="<?php echo$row->Telefone_Cli ?>"
										name="telefone" required>
								</div>
								<div class="form-group">
									<label>E-mail</label> <input class="form-control" type="email"
										value="<?php echo $row->Email_Cli ?>" name="email" required>
								</div>
								<div class="form-group">
									
									<?php 
										if($row->Newsletter == true): 
										echo "<input name='news' type='checkbox' checked>"; 
										else : 
										echo " <input name='news' type='checkbox'>"; 
										endif;?>
										<label>Newsletter</label> 
								</div>
										<?php endforeach;?>
                                        <div class="col-md-5">
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
