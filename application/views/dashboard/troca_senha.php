<?php
header("Content-type: text/html; charset=utf-8"); 
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
                    <h1 class="page-header">Troca de Senha</h1>
                </div>
            </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default" style="margin-top: 70px;">
                    <div class="panel-body">
                        <form action="<?php echo base_url('index.php/Dashboard/senha')?>" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Nova Senha" name="senha1" type="password" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirmar Nova Senha" name="senha2" type="password" value="" required>
                                </div>
                                <input type="hidden" name="sessao" value="<?php echo $this->session->userdata("tipo") ?>">
                                <input type="hidden" name="user" value="<?php echo $this->session->userdata("user") ?>">
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Trocar</button>
                            </fieldset>
                        </form> 
                    </div>  
                </div>
                 <?php if($msg = get_msg()): echo '<div class="msg-box">'.$msg.'</div>'; endif;?>
            </div>
        </div>
            </div>
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
