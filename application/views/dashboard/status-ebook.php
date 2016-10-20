<?php
$this->load->view('dashboard/nav-admin');
foreach ($ebook as $ebooks):
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Status Ebook</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Informações do Ebook:</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="<?php echo base_url('index.php/Ebook/muda_status')?>?cod=<?php echo $ebooks->idEbook ?>" method="post" enctype="multipart/form-data" >
                                      
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input class="form-control" readonly name="status" id="statusInput" value="<?php if($ebooks->Status_Ebook == true): echo "Ativo"; else : echo " Inativo"; endif;?>">
                                        </div>
                                  
                                        <div class="form-group">
                                            <label>Data de Cadastro</label>
                                            <input class="form-control" readonly type="text" name="datacad" value="<?php echo $ebooks->Data_Cadastro?>">
                                        </div>
                                        <button type="submit" role="button" id="update" class="btn btn-primary" style="margin-top: 10px;" >Mudar Status</button>
                                        <?php endforeach;?>
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
    <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js')?>"></script>
    <script src="<?php echo base_url('assets/dist/js/sb-admin-2.js')?>"></script>
</body>
</html>
