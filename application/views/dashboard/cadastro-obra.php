<?php 
	$this->load->view('dashboard/nav-cli');
 ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Cadastro de Ebook</h1>
                </div>
            </div>
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Informações do Ebook:</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                <?php if($msg = get_msg()): echo '<div class="msg-box">'.$msg.'</div>'; endif;?>
                                    <form role="form" action="<?php echo base_url('index.php/Ebook/insere_ebook')?>" method="post" enctype="multipart/form-data" >
                                        <div class="form-group">
                                            <label>Titulo do Ebook</label>
                                            <input class="form-control" required="required" name="titulo">
                                        </div>
                                        <div class="form-group">
                                            <label>Categoria</label>
                                            <input class="form-control" required="required" name="categoria">
                                        </div>
                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <input class="form-control" required="required" name="descricao">
                                        </div>

                                       <div class="form-group">
                                            <label>Autor</label>
                                            <input class="form-control" required="required" name="autor">
                                        </div>
                                        <div class="form-group">
                                            <label>Preço</label>
                                            <input class="form-control" type="number" name="preco">
                                        </div>
                                   
                                        <label for="file">Escolha um arquivo para a capa da sua obra </label>
                                        <input type="file" name="capa" required style="margin-bottom: 10px;">
                                        
                                        <label for="file">Faça upload da sua obra (Apenas o arquivo no formato PDF) </label>
                                        <input type="file" name="obra" required>
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
