<?php $this->load->view ( 'plataforma/head' );?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/sobre.css')?>">
<?php $this->load->view ( 'plataforma/nav' );?>
<section>
  <article>
  <?php foreach ($ebook as $dados):?>
    <div class="livro">
       <a href="<?php echo base_url('sobre')?>"><img src="<?php echo $dados->Capa ?>"></img></a>
    </div>
    <div class="sobre">
      <h1><?php echo $dados->Titulo_Ebook ?></h1><br>
      <h2><?php echo $dados->Categoria ?></h2><br>
      <p><?php echo $dados->Autor_Ebook ?></p>
      <div class="valor">
        <div class="width50">
          <h2>R$ <?php echo $dados->Preco_Ebook ?></h2>
          <p>ou 2x de R$ <?php echo ($dados->Preco_Ebook/2) ?></p>
        </div>
        <div class="width50 txt-center" style="margin-top: 80px;">
          <a href="#" class="comprar">Comprar</a>
        </div>
      </div>
    </div>
    <div class="prevacio">
      <h1>Prefácio</h1>
      <hr><br>
      <p><?php echo $dados->Descricao_Ebook?></p>
      <?php endforeach;?>
    </div>
  </article>
</section>
<?php $this->load->view ( 'plataforma/footer' );?>
        <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/mobile.js')?>"></script>
</body>
</html>
