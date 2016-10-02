<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Friends Dashboard Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/dist/css/sb-admin-2.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
    
    <!-- Custom Error panel  -->
    <link href="<?php echo base_url('assets/css/painel.css') ?>" rel="stylesheet" type="text/css">
    

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Acesso Restrito</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo base_url('index.php/Admin/login')?>" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Login" name="login" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="senha" type="password" value="" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Lembrar me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
                            </fieldset>
                        </form> 
                    </div>  
                </div>
                 <?php if($msg = get_msg()): echo '<div class="msg-box">'.$msg.'</div>'; endif;?>
            </div>
        </div>
    </div>

<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bower_components/metisMenu/dist/metisMenu.min.js')?>"></script>
    <script src="<?php echo base_url('assets/dist/js/sb-admin-2.js')?>"></script>

</body>

</html>
