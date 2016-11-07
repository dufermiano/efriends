<?php $this->load->view ( 'plataforma/head' );?>
<link rel="stylesheet"
	href="<?php echo base_url('assets/css/sobre.css')?>">
<?php $this->load->view ( 'plataforma/nav' );?>
<section>
	<article>
  <?php foreach ($ebook as $dados):?>
    <div class="livro">
			<a href="<?php echo base_url('sobre')?>"><img
				src="<?php echo $dados->Capa ?>"></img></a>
		</div>
		<div class="sobre">
			<h1><?php echo $dados->Titulo_Ebook ?> </h1>
			<br>
			<h2><?php echo $dados->Categoria ?></h2>
			<br>
			<p><?php echo $dados->Autor_Ebook ?></p>
			<p>Responsável pela obra: <?php echo $dados->Nome_Cli ?> </p>
			<div class="valor">
				<?php if($dados->Preco_Ebook == 0.00):?>
					<div class="width50">
						<h2>Publicação! </h2>
						<p>Você não precisa pagar nada para ler esse livro, apenas clique em "Acessar" e ele será disponibilizado para você</p>
					
					<?php
						$logado = $this->session->userdata ( 'logado' );
						if ($logado != true) :
					?>
          				<a href="#" onclick="mensagem()" class="comprar">Acessar</a>
    				<?php else:  ?>  
    				<div class="width50 txt-center" style="margin-top: 80px;">
    				<a href='#' class='comprar' onclick='pegalink()'>Acessar</a>
		  			</div>
   				 	<?php endif;?>
					</div>
					
				<?php else:?>
					<div class="width50">
						<h2>R$ <?php echo $dados->Preco_Ebook ?></h2>
						<p>ou 2x de R$ <?php echo ($dados->Preco_Ebook/2) ?></p>
					<?php
						$logado = $this->session->userdata ( 'logado' );
						if ($logado != true) :
					?>
          					<a href="#" onclick="mensagem()" class="comprar">Comprar</a>
    				<?php else:  ?>  
    						<div class="width50 txt-center" style="margin-top: 80px;">
		  						<a href='#' class='comprar' onclick='enviaPagseguro()'>Comprar</a>
		  					</div>
							<form id="comprar"
								action="https://pagseguro.uol.com.br/checkout/v2/payment.html"
								method="post" onsubmit="PagSeguroLightbox(this); return false;">
								<input type="hidden" name="code" id="code" value="" />
							</form>
							<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
   				 	<?php endif;?>
					</div>
				<?php endif;?>
			</div>
		</div>
		<div class="prevacio">
			<h1>Prefácio</h1>
			<hr>
			<br>
			<p><?php echo $dados->Descricao_Ebook?></p>
      <?php endforeach;?>
    </div>
	</article>
</section>
<?php $this->load->view ( 'plataforma/footer' );?>
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/mobile.js')?>"></script>
<script src="<?php echo base_url('assets/js/pagseguro.js')?>"></script>
</body>
</html>
