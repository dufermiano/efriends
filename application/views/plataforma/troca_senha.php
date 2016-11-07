<?php
$this->load->view ( 'plataforma/head' );
$this->load->view ( 'plataforma/nav' );?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css')?>">
    <section>
      <article>
        <form action="index.php/Cliente/muda_senha" method="post">
            <h3>Troque a senha:</h3>
            <input type="text" placeholder="Nova Senha" name="senha1"> 
            <input type="text" placeholder="Confirme a nova senha" name="senha2"> 
            <button>Enviar</button>
        </form>
        <?php if($msg = get_msg()): echo '<div class="msg-box" style="margin-top:5px;">'.$msg.'</div>'; endif;?>
      </article>
    </section>
    <?php $this->load->view ( 'plataforma/footer' );?>
   <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/mobile.js')?>"></script>
  </body>
</html>
    