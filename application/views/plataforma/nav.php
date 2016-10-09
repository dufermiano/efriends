</head>
<body class="desktop" id="mobile">
  <header>
    <div class="mobile-only oc"><img src="img/menu.png"></div>
    <nav>
      <ul>
        <li><a href="<?php echo base_url('plataforma')?>">E-Friends</a></li>
        <li><a href="<?php echo base_url('todos')?>">Todos</a></li>
        <li><a href="<?php echo base_url('categoria')?>">Categorias</a></li>
        <li><a href="<?php echo base_url('cadastro_cli')?>">Cadastra-se</a></li>
        <li><a href="<?php echo base_url('login')?>">Login</a></li>
      </ul>
      <div class="desktop-only pesquisa">
        <input type="text" placeholder="Pesquisar...">
      </div>
      <div class="desktop-only user" style="margin-right:20px;">
      <?php if($this->session->userdata('tipo') == "cliente"):?>
       <a href="inicio_dash">Bem vindo, <?php echo $this->session->userdata('user');?>!</a>
       <?php else: ?>
          <a href="#">Bem vindo, Visitante!</a>
        <?php endif;?>
        </div>
    </nav>
  </header>
