<?php $this->load->view("plataforma/head");?>
<?php $this->load->view ( 'plataforma/nav' );?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/cadastro.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css')?>">
<section>
      <article>
        <div class="alert" id="alert">
          <p>Para comprar ou vender e-books na E-Friends é necessario se cadastrar!</p>
        </div>
        
        <?php if($msg = get_msg()): echo '<div class="msg-box">'.$msg.'</div>'; endif;?>
        <form action="index.php/Cliente/insere_cliente" method="post">
            <h3>Informações do Cliente:</h3>
            <input type="text" placeholder="Nome" name="nome" required>
            <input type="text" placeholder="Telefone" name="telefone" required>
            <input type="text" placeholder="E-Mail" name="email" required>
            <input type="text" placeholder="CPF" name="cpf" required>
            <h3>Usuario</h3>
            <input type="text" placeholder="Usuario" name="login" required>
            <input type="password" placeholder="Senha" name="senha" required>
            <input type="password" placeholder="Confirmar Senha" name="senha2" required>
            <select name="pergunta" required>
              <option>Pergunta de segurança</option>
              <option value="1" >Mês de aniversario?</option>
              <option value="2">Time do coração?</option>
              <option value="3">Qual o nome do seu cachorro?</option>
            </select>
            <input type="text" placeholder="Resposta" name="resposta" required>
            <input class="newsletter" type="checkbox" name="newsletter"><label>Newsletter</label><br>
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

