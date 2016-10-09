<?php 
$this->load->view ( 'plataforma/head' );
$this->load->view ( 'plataforma/nav' );?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/cadastro.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css')?>">
 <section>
      <article>
        <form action="<?php echo base_url('index.php/Cliente/login')?>" method="post">
			<h3>Login do Cliente:</h3>
			<input type="text" placeholder="Usuario" required name='login'> 
			<input type="password" placeholder="Senha" required name='senha'>
			<button>Entrar</button> <?php if($msg = get_msg()): echo '<div class="msg-box">'.$msg.'</div>'; endif;?>
		</form>
 	</article>
 	</section>

<?php $this->load->view ( 'plataforma/footer' );?>
        <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/mobile.js')?>"></script>
  </body>
</html>