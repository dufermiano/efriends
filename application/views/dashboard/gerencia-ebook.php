<?php
	$this->load->view('dashboard/nav-admin');
	foreach ($ebook as $ebooks):
	
?>
	<script type="text/javascript">

		function trocaStatus(){

			var x = document.getElementById("statusSelect").value;
			document.getElementById("statusInput").value = x;
			}
	
    </script>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gerenciamento de Ebook</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Informações do Ebook:</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="<?php echo base_url('index.php/Ebook/altera_ebook')?>?cod=<?php echo $ebooks->idEbook ?>" method="post" enctype="multipart/form-data" >
                                        <div class="form-group">
                                            <label>Titulo do Ebook</label>
                                            <input class="form-control" required="required" name="titulo" value="<?php echo $ebooks->Titulo_Ebook ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Categoria</label>
                                            <input class="form-control" required="required" name="categoria" value="<?php echo $ebooks->Categoria?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <input class="form-control" required="required" name="descricao" value="<?php echo $ebooks->Descricao_Ebook?>">
                                        </div>

                                       <div class="form-group">
                                            <label>Autor</label>
                                            <input class="form-control" required="required" name="autor" value="<?php echo $ebooks->Autor_Ebook?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input class="form-control" readonly name="status" id="statusInput" value="<?php if($ebooks->Status_Ebook == true): echo "Ativo"; else : echo " Inativo"; endif;?>">
                                            
                                            <select class="form-control" id="statusSelect"style="margin-top: 5px;" onclick="trocaStatus()">
                                            <option>Ativo</option>
                                            <option>Inativo</option>
                                            </select> 
                                             
                                        </div>
                                        <div class="form-group">
                                            <label>Preço</label>
                                            <input class="form-control" required="required" type="number" name="preco" value="<?php echo $ebooks->Preco_Ebook?>">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Data de Cadastro</label>
                                            <input class="form-control" readonly type="text" name="datacad" value="<?php echo $ebooks->Data_Cadastro?>">
                                            
                                        </div>
                                        <label for="file">Atualize o arquivo de capa </label>
                                        <input type="file" name="capa" style="margin-bottom: 10px;">
                                        
                                        
                                        <label for="file">Atualize a sua obra (arquivo .zip contendo o PDF)</label>
                                        <input type="file" name="obra">
                                        
                                        <button type="submit" role="button" id="update" class="btn btn-primary" style="margin-top: 10px;" >Alterar</button>
                                        <a href="<?php echo base_url('index.php/Ebook/exclui_ebook')?>?cod=<?php echo $ebooks->idEbook ?>" role="button" class="btn btn-danger" id="excluir" style="margin-top: 10px;">Excluir</a>
                                        
                                        <p style="margin-top: 10px;"><?php // print $row["capa"]; ?></p>
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
