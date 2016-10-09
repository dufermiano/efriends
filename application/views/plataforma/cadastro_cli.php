<?php $this->load->view("plataforma/head");?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/cadastro.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/painel.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
<?php $this->load->view ( 'plataforma/nav' );?>
<section>
	<article>
		<form action="<?php echo base_url('index.php/Cliente/insere_cliente')?>" method="post">
		<div class="alert">
          <p>Para comprar ou vender e-books na E-Friends é necessario se cadastrar!</p>
        </div>
            <h3>Informações do Cliente:</h3>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">	
			            <input style="width:100%;" type="text" placeholder="Nome" name='nome' required>
					</div>
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">	
			            <input style="width:100%;" type="text" placeholder="Telefone" name='telefone' required>
					</div>	
				</div>	
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">	
			             <input style="width:100%;" type="text" placeholder="E-Mail" name='email' required>
					</div>
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" id="divcpf" >	
			           <input style="width:100%;" type="text" aria-describedby="inputSuccess4Status" placeholder="CPF" class="form-control" name="cpf" id="cpf" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" required>
					</div>	
				</div>	
			</div>
        
            <h3>Usuario</h3>
            	<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
				   	  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">	
			           <input style="width:100%;" type="text" placeholder="Usuario" required name='login'>
					  </div>
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">	
			            <input style="width:100%;" type="password" placeholder="Senha" required name='senha'>
					</div>	
				</div>	
			</div>
			  	<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
				   	  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">	
			            <input style="width:100%;" type="password" placeholder="Confirmar Senha" required name='senha2'>
					  </div>
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">	
			             <input class="newsletter" type="checkbox"><label>Newsletter</label><br>
					</div>	
				</div>	
				<button style="margin-left:30px;" id='btncad' disabled>Cadastrar</button> 
			</div>
            
            
           
           
            
            <?php if($msg = get_msg()): echo '<div class="msg-box">'.$msg.'</div>'; endif;?>
		</form>
	</article>
</section>
<?php $this->load->view ( 'plataforma/footer' );?>

<script src="<?php echo base_url('assets/js/cpf.js')?>"></script>
<script src="<?php echo base_url('assets/js/mobile.js')?>"></script>
<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
</body>
</html>
