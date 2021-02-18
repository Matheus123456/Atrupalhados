<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo-bobo.png">
    <title>Atrupalhados - Login</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(assets/images/foto_login.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="assets/images/logo_trupe.jpg" alt="wrapkit" width="150px">
                        </div>
                        <form class="mt-4" id="login" method="POST">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Email</label>
                                        <input class="form-control" id="uname" type="text" name="email" placeholder="Insira seu email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Senha</label>
                                        <input class="form-control" id="pwd" type="password" name="senha" placeholder="Insira sua senha">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="button" class="btn btn-block btn-dark" id="button-login">Entrar</button>
                                </div>
                                
                                <div class="col-lg-12 mt-5">
                                    Ainda não tem conta? <a href="cadastrar.php" class="text-danger">Cadastre-se</a><br>
                                    Esqueceu sua senha? <a data-toggle="modal" data-target="#recuperar_modal" style="cursor: pointer;" class="text-danger">Recupere!</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="recuperar_modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body">
                        <div class="text-center mt-2 mb-4">
                            <h3>Recuperar Acesso!</h3>
                        </div>

                        <form class="pl-3 pr-3" action="#">

                            <div class="form-group">
                                <label for="username">Email</label>
                                <input class="form-control email_recuperar" type="email" name="email_recuperar" placeholder="Digite o endereço de email cadastrado">
                                <div class="invalid-feedback">
                                    Desculpe, não encontramos nenhuma conta cadastrada com esse email!
                                </div>
                            </div>

                            <input type="hidden" name="funcao" value="recuperar_senha">

                            <div class="form-group">
                                <button class="btn btn-primary" type="button" id="button_recuperar" disabled>Recuperar</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js "></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>

<script>
    $(".preloader ").fadeOut();

    jQuery(".email_recuperar").blur(function(){
		var email_recuperar = $(this).val();
        var funcao = 'verificar_email';
        var caracteres = email_recuperar.length;

        if(caracteres > 0) {
            $.ajax({
                type : 'POST',
                url  : 'functions.php',
                data : {'email': email_recuperar, 'funcao': funcao},
                dataType: 'json',
                beforeSend: function()
                {
                    //$("#button-login").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Autenticando...');
                },
                error: function()
                {
                    //$("#button-login").html('ENTRAR');
                },
                success: function(response){
                    if($.trim(response) == 0){
                        $('#button_recuperar').prop('disabled', true);
                        $('.email_recuperar').addClass('is-invalid');
                    } else {
                        $('#button_recuperar').prop('disabled', false);
                        $('.email_recuperar').removeClass('is-invalid');
                    }   
                }
            });
        }
	});

    jQuery("#button-login").click(function(){
		var data = $("#login").serialize();

  		$.ajax({
  			type : 'POST',
  			url  : 'logar.php',
  			data : data,
  			dataType: 'json',
            error: function()
            {
                $("#button-login").html('ENTRAR');
            },
            beforeSend: function()
            {
                $("#button-login").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Autenticando...');
            },
            success: function(response){
                $("#button-login").html('ENTRAR');
                if($.trim(response) == 'sem_acesso'){
                    swal("Ops!", "Você ainda não tem acesso. Aguarde até um administrador validar seu acesso!", "warning");
                } else if($.trim(response) == 'entrou'){
                    window.location.href = "index.php";
                } else if($.trim(response) == 'incorreto') {
                    swal("Ops!", "Você digitou sua senha ou seu email incorretamente!", "warning");
                } else {
                    swal("Ops!", "Você deve digitar seu email e sua senha para entrar!", "warning");
                }
            }
  		});
	});

    jQuery("#button_recuperar").click(function(){
		var email = $(".email_recuperar").val();
        var funcao = 'recuperar_senha';

  		$.ajax({
  			type : 'POST',
  			url  : 'functions.php',
  			data : {'email': email, 'funcao': funcao},
  			dataType: 'json',
            error: function()
            {
                $("#button_recuperar").html('Recuperar');
            },
            beforeSend: function()
            {
                $("#button_recuperar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde');
            },
            success: function(response){
                $("#button_recuperar").html('Recuperar');

                if($.trim(response) == 'success'){
                swal({
                    title: "Perfeito!",
                    text: "Foi enviado um email com um link para alteração. O link tem prazo máximo de 1 dia!",
                    icon: "success",
                    buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        location.reload();
                    } else {
                        location.reload();
                    }
                });
                }                
            }
  		});
	});

</script>

</body>

</html>
