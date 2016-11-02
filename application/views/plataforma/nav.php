    </head>
  <body class="desktop" id="mobile">
    <header>
      <div class="mobile-only oc"><img src="img/menu.png"></div>
      <nav>
        <ul>
           <li><a href="<?php echo base_url('plataforma')?>">E-Friends</a></li>
        <li><a href="<?php echo base_url('todos')?>">Todos</a></li>
        <li><a href="<?php echo base_url('categorias')?>">Categorias</a></li>
           <?php 
        	$user = $this->session->userdata('user');
        	$tipo = $this->session->userdata('tipo'); 	
        	if($user == null || $tipo != 'cliente'):
        	?>
        		<li><a href="<?php echo base_url('cadastro_cli')?>">Cadastro</a></li>
        		<li><a href="<?php echo base_url('login')?>">Login</a></li>
        	<?php else:?>
        		<li><a href="<?php echo base_url('logout')?>">Logout</a></li>
        	<?php endif; ?>
      </ul>
        <div class="desktop-only pesquisa">
          <input type="text" placeholder="Pesquisar...">
        </div>
        <div class="desktop-only user">
         <?php if($this->session->userdata('tipo') == "cliente"):?>
       <a href="inicio_dash"><span class="icon-home"><p class="user"><?php echo $this->session->userdata('user');?></p></span></a>
       <?php else: ?>
       <a href="<?php echo base_url('login')?>"><span class="icon-home"><p class="user">Visitante</p></span></a>
        <?php endif;?>
        </div>
      </nav>
    </header>