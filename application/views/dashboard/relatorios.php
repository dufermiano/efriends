<?php 
$sessao = $this->session->userdata('tipo');
if($sessao == 'cliente'){
	$this->load->view('dashboard/nav-cli');
}
else{
	$this->load->view('dashboard/nav-admin');
}
 ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Relatórios</h1>
                </div>
        <div class="col-lg-12">
                    <h1 class="page-header">Análise de inscritos</h1>
                </div>
            </div>
         <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Gráfico de inscritos
                            <div class="pull-right">

                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>

                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
              </div>
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js')?>"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url('assets/bower_components/raphael/raphael-min.js')?>"></script>
    <script src="<?php echo base_url('assets/bower_components/morrisjs/morris.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/morris-data.js')?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/dist/js/sb-admin-2.js')?>"></script>


</body>

</html>
