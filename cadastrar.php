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
                        <form class="mt-4" id="cadastrar" method="POST">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Email</label>
                                        <input type="text" class="form-control email_id" type="email" name="email" placeholder="Insira seu email">
                                        <div class="invalid-feedback">
                                            Desculpe, esse email já está cadastrado!
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Nome Completo</label>
                                        <input class="form-control" type="name" name="nome" placeholder="Insira seu nome completo">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Número de Celular</label>
                                        <input class="form-control" id="celular" type="text" name="celular" placeholder="(xx) xxxxx-xxxx">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Senha</label>
                                        <input class="form-control" id="uname" type="password" name="senha" placeholder="Insira sua senha">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Confirmar Senha</label>
                                        <input class="form-control" id="uname" type="password" name="confirmasenha" placeholder="Insira sua senha novamente">
                                    </div>
                                </div>

                                <input type="hidden" name="funcao" value="cadastrar_usuario">
                                
                                <div class="col-lg-12 text-center">
                                    <button type="button" class="btn btn-block btn-dark" id="button-cadastrar" disabled>Cadastrar</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Já tem cadastro? <a href="login.php" class="text-danger">Entre!</a><br>
                                </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    $(".preloader").fadeOut();
    jQuery('#celular').mask('(99) 99999-9999');


    jQuery(".email_id").blur(function(){
        var email = $(this).val();
        var funcao = 'verificar_email';
        //var class = $(this).attr('class');

  		$.ajax({
  			type : 'POST',
  			url  : 'functions.php',
  			data : {'email': email, 'funcao': funcao},
            dataType: 'json',
            beforeSend: function()
  			{
  			   //$("#button-cadastrar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cadastrando...');
  			},
            error: function()
            {
                //$("#button-cadastrar").html('Cadastrar');
            },
  			success: function(response) {
                if($.trim(response) == 0){
                    $('#button-cadastrar').prop('disabled', false);
                    $('.email_id').removeClass('is-invalid');
                } else {
                    $('#button-cadastrar').prop('disabled', true);
                    $('.email_id').addClass('is-invalid');
                }             
  		    }
  		});
	});

    jQuery("#button-cadastrar").click(function(){
		  var data = $("#cadastrar").serialize();

  		$.ajax({
  			type : 'POST',
  			url  : 'functions.php',
  			data : data,
            dataType: 'json',
            beforeSend: function()
  			{
  			   $("#button-cadastrar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cadastrando...');
  			},
            error: function()
            {
                $("#button-cadastrar").html('Cadastrar');
            },
  			success: function(response) {
                $("#button-cadastrar").html('Cadastrar');
                if($.trim(response) == 'email_vazio'){
                    swal("Ops!", "Seu email não pode estar vazio!", "warning");
                } else if($.trim(response) == 'nome_vazio'){
                    swal("Ops!", "Seu nome não pode estar vazio ", "warning");
                } else if($.trim(response) == 'celular_vazio'){
                    swal("Ops!", "Seu número de celular não pode estar vazio ", "warning");
                } else if($.trim(response) == 'senha_vazio'){
                    swal("Ops!", "Defina uma senha!", "warning");
                } else if($.trim(response) == 'confirmarsenha_vazio'){
                    swal("Ops!", "Você deve confirmar sua senha para se cadastrar!", "warning");
                } else if($.trim(response) == 'caracter_invalido'){
                    swal("Ops!", "Sua senha deve possuir de 8 à 16 caracteres!", "warning");
                } else if($.trim(response) == 'senhas_diferentes'){
                    swal("Ops!", "As senhas não conferem!", "warning");
                } else {
                    swal({
                        title: "Perfeito!",
                        text: "Seu cadastro foi recebido com sucesso e em breve um administrador validará seus dados!",
                        icon: "success",
                        buttons: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = "login.php";
                        } else {
                            window.location.href = "login.php";
                        }
                    });
                }
  		    }
  		});
	});

</script>

</body>

</html>
