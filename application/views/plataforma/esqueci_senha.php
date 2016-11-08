<?php 
$this->load->view ( 'plataforma/head' );
$this->load->view ( 'plataforma/nav' );?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css')?>">
    <section>
      <article>
        <form action="index.php/Cliente/EnviarEmail" method="post">
            <h3>Login:</h3>
            <input type="text" placeholder="Usuario" name="login"> 
            <select name="pergunta">
              <option>Pergunta de segurança</option>
              <option value="1">Qual o nome do seu cachorro?</option>
              <option value="2">Time do coração?</option>
              <option value="3">Mês de aniversario?</option>
            </select>
            <input type="text" placeholder="Resposta" name="resposta">
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
    