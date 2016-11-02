<?php $this->load->view("plataforma/head");?>
<?php $this->load->view ( 'plataforma/nav' );?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/cadastro.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css')?>">
<section>
      <article>
        <div class="alert" id="alert">
          <p>Para comprar ou vender e-books na E-Friends é necessario se cadastrar!</p>
        </div>
        <form action="" method="">
            <h3>Informações do Cliente:</h3>
            <input type="text" placeholder="Nome">
            <input type="text" placeholder="Telefone">
            <input type="text" placeholder="E-Mail">
            <input type="text" placeholder="CPF">
            <h3>Usuario</h3>
            <input type="text" placeholder="Usuario">
            <input type="password" placeholder="Senha">
            <input type="password" placeholder="Confirmar Senha">
            <select>
              <option>Pergunta de segurança</option>
              <option>Qual o nome do seu cachorro?</option>
              <option>Time do coração?</option>
              <option>Mês de aniversario?</option>
            </select>
            <input type="text" placeholder="Resposta">
            <input class="newsletter" type="checkbox"><label>Newsletter</label><br>
            <button>Cadastrar</button>
        </form>
      </article>
    </section>
    <footer>
      <p>&copy Copyright 2016 E-Friends</p>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/mobile.js"></script>
  </body>
</html>

