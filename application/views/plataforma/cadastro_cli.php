<?php include("head.php");?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/cadastro.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css')?>">
<?php $this->load->view ( 'plataforma/nav' );?>
<section>
	<article>
		<form action="<?php echo base_url('index.php/Cliente/insere_cliente')?>" method="post">
		<div class="alert">
          <p>Para comprar ou vender e-books na E-Friends é necessario se cadastrar!</p>
        </div>
            <h3>Informações do Cliente:</h3>
            <input type="text" placeholder="Nome" name='nome' required>
            <input type="text" placeholder="Telefone" name='telefone' required>
            <input type="text" placeholder="E-Mail" name='email' required>
            <input type="text" placeholder="CPF" name='cpf' required>
            <h3>Usuario</h3>
            <input type="text" placeholder="Usuario" required name='login'>
            <input type="password" placeholder="Senha" required name='senha'>
            <input type="password" placeholder="Confirmar Senha" required name='senha2'>
            <input class="newsletter" type="checkbox"><label>Newsletter</label><br>
            <button>Cadastrar</button> <?php if($msg = get_msg()): echo '<div class="msg-box">'.$msg.'</div>'; endif;?>
		</form>
	</article>
</section>
<?php $this->load->view ( 'plataforma/footer' );?>
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/mobile.js')?>"></script>
</body>
</html>
