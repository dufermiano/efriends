<?php 
$this->load->view ( 'plataforma/head' );
$this->load->view ( 'plataforma/nav' );?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css')?>">
    <section>
      <article>
        <form action="" method="post">
            <h3>Login:</h3>
            <input type="text" placeholder="Usuario">
            <select>
              <option>Pergunta de segurança</option>
              <option>Qual o nome do seu cachorro?</option>
              <option>Time do coração?</option>
              <option>Mês de aniversario?</option>
            </select>
            <input type="text" placeholder="Resposta">
            <button>Enviar</button>
        </form>
      </article>
    </section>
    <?php $this->load->view ( 'plataforma/footer' );?>
        <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/mobile.js')?>"></script>
  </body>
</html>
    