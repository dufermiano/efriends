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
                <h1 class="page-header">Catálogo de obras</h1>
            </div>
        </div>
        <div class="row">
        
        	<?php if($msg = get_msg()): echo '<div class="msg-box">'.$msg.'</div>'; endif;?>    
            <?php foreach ($ebook as $catalogo): ?>
            
            <div class="col-lg-3 col-md-4 col-xs-6 thumb"> 
                <a class="thumbnail" href="<?php echo base_url('gerencia_ebook')?>?cod=<?php echo $catalogo->idEbook  ?>">
                    <img class="img-responsive" src="<?php echo $catalogo->Capa ?>">
                </a>
                <h3>
                    <a href="<?php echo base_url('gerencia_ebook')?>?cod=<?php echo $catalogo->idEbook  ?>"><?php echo $catalogo->Titulo_Ebook  ?></a>
                </h3>
                <p><?php echo $catalogo->Descricao_Ebook  ?></p>
            </div>
            
            <?php endforeach; ?>
            
        </div>
      </div>
        <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js')?>"></script>
        <script src="<?php echo base_url('assets/dist/js/sb-admin-2.js')?>"></script>
    </body>
    </html>
