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
      <?php /* if($this->session->userdata('status') != null):
        	echo "<div>Bem vindo ".$this->session->userdata('user')."</div>";
        	endif*/
        	?>
      <div class="desktop-only pesquisa">
        <input type="text" placeholder="Pesquisar...">
      </div>
    </nav>
  </header>
