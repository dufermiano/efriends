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
                            <h1 class="page-header">Dashboard</h1>
                        </div>

                         <div class="col-lg-9">
                 </div>

                    <div class="col-lg-12">
                    <h1 class="page-header">Notificações</h1>
                </div>

                    <div class="col-lg-4 col-md-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">26</div> <!-- Valor a ser trazido do banco-->
                                        <div>Novos comentários</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Detalhes</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">124</div> <!-- Valor a ser trazido do banco-->
                                        <div>Análise de Vendas</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Detalhes</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">13</div> <!-- Valor a ser trazido do banco-->
                                        <div>Solicitações</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Detalhes</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                    </div>
                    <!-- /#page-wrapper -->

                </div>
            </div>
        </div>
            <!-- /#wrapper -->

            <!-- /.panel-heading -->

            <!-- jQuery -->
            <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>

            <!-- Metis Menu Plugin JavaScript -->
            <script src="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js')?>"></script>

            <!-- Morris Charts JavaScript -->
            <script src="<?php echo base_url('assets/bower_components/raphael/raphael-min.js')?>"></script>

            <script src="<?php echo base_url('assets/js/morris-data.js"')?>></script>

            <!-- Custom Theme JavaScript -->
            <script src="<?php echo base_url('assets/dist/js/sb-admin-2.js')?>"></script>


        </body>

        </html>
