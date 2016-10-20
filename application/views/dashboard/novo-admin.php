<?php
$this->load->view('dashboard/nav-admin');
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Cadastro de Administrador</h1>
                </div>
            </div>
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Informações do Administrador:</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                <?php if($msg = get_msg()): echo '<div class="msg-box">'.$msg.'</div>'; endif;?>
                                    <form role="form" action="<?php echo base_url('index.php/Admin/insere_admin')?>" method="post" enctype="multipart/form-data" >
                                        <div class="form-group">
                                            <label>Login</label>
                                            <input class="form-control" required="required" name="login">
                                        </div>
                                        <div class="form-group">
                                            <label>Senha</label>
                                            <input class="form-control" type="password" required="required" name="senha">
                                        </div>
                                           <div class="form-group">
                                            <label>Confirmação de Senha</label>
                                            <input class="form-control" type="password" required="required" name="senha2">
                                        </div>
                                        <div class="form-group">
                                            <label>Nome do Administrador</label>
                                            <input class="form-control" required="required" name="nome">
                                        </div>
                                       <div class="form-group">
                                            <label>Telefone do Administrador</label>
                                            <input class="form-control" required="required" name="tel">
                                        </div>
                                        <div class="form-group">
                                            <label>Email do Administrador</label>
                                            <input class="form-control" type="email" name="email">
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="cadastro" name="btnEnviar" style="margin-top: 10px;">Cadastrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </div>
    
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js')?>"></script>
    <script src="<?php echo base_url('assets/dist/js/sb-admin-2.js')?>"></script>
</body>
</html>
