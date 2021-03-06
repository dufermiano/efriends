<?php
	$this->load->view ( 'dashboard/nav-admin' );
?>
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/relatorios.js')?>"></script>
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js')?>"></script>
<script src="<?php echo base_url('assets/bower_components/raphael/raphael-min.js')?>"></script>
<script src="<?php echo base_url('assets/bower_components/morrisjs/morris.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/morris-data.js')?>"></script>
<script src="<?php echo base_url('assets/dist/js/sb-admin-2.js')?>"></script>


<div id="page-wrapper">
<div class="row">
  <h2>Relatórios</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Inscritos</a></li>
    <li><a data-toggle="tab" href="#menu1">Cientes</a></li>
    <li><a data-toggle="tab" href="#menu2">Ebooks</a></li>
  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
    <h3>Análise de inscritos</h3>
		<p>
			<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> Gráfico de inscritos
					<div class="pull-right"></div>
				</div>
				<div class="panel-body">
					<div id="morris-area-chart"></div>
				</div>
			</div>
		</div>
	</div>
		</p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3 style="margin-left:20px;">Clientes</h3>
      	<p>
   		<div class="col-lg-10 col-md-5">
			<div class="panel">
				<div class="panel-heading">
					<div class="row">
					<div class="panel panel-primary">
							<table id="main_table" class="table table-striped table-hover" style="">
								<thead>
									<tr>
										<th>Código do Cliente</th>
										<th>Nome do Cliente</th>
										<th>Data da ação</th>
										<th>Ação</th>
									
									</tr>
								</thead>
							<tbody id="corpoCliente">
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3 style="margin-left:20px;">Ebooks</h3>
      <p>
      			<div class="col-lg-10 col-md-5">
			<div class="panel">
				<div class="panel-heading">
					<div class="row">
					<?php if($msg = get_msg()): echo '<div class="msg-box" style="margin-left: 60px;" >'.$msg.'</div>'; endif;?>  
					<div class="panel panel-primary">
							<table id="main_table" class="table table-striped table-hover" style="">
								<thead>
									<tr>
										<th>Código do Livro</th>
										<th>Titulo do Livro</th>
										<th>Data da ação</th>
										<th>Ação</th>
										
									</tr>
								</thead>
								<tbody id="corpoLivro">
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
      </p>
    </div>
  </div>
</div>
</div>
				
				
		


				</body>

				</html>