<?php 
$this->load->view ( 'plataforma/head' );
$this->load->view ( 'plataforma/nav' );?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css')?>">
    <section>
      <article>
        <form action="<?php echo base_url('index.php/Cliente/login')?>" method="post">
            <h3>Login:</h3>
            <input type="text" placeholder="Usuario" required name='login'>
            <input type="password" placeholder="Senha" required name='senha'>
            <a class="esqueci-senha" href="<?php echo base_url('esqueci_senha')?>">Esqueci a senha</a><br>
            <button>Login</button> 
        </form>
        <?php if($msg = get_msg()): echo '<div class="msg-box" style="margin-top: 10px;">'.$msg.'</div>'; endif;?>
      </article>
    </section>

<?php $this->load->view ( 'plataforma/footer' );?>
        <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/mobile.js')?>"></script>
  </body>
</html>

  