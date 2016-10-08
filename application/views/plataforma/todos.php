<?php
$this->load->view ( 'plataforma/head' );
$this->load->view ( 'plataforma/nav' );
?>
    <section>
      <article>
        <h1>Todos os livros</h1>
        <hr>
        <div class="container">
        <?php foreach($dados as $ebook):?>
          <div class="livro">
            <a href="<?php echo base_url('sobre')?>?cod=<?php echo $ebook->idEbook ?>" class="desktop-only btn">Sobre o livro</a>
            <a href="<?php echo base_url('sobre')?>?cod=<?php echo $ebook->idEbook ?>"><img src="<?php echo $ebook->Capa?>"></img></a>
            <h2><?php echo $ebook->Titulo_Ebook?></h2>
          </div>
          <?php endforeach;?>
        </div>
      </article>
    </section>
		<?php $this->load->view ( 'plataforma/footer' );?>
        <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('assets/js/mobile.js')?>"></script>
  </body>
</html>
