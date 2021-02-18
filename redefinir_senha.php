<?php 

include('conexao.php');

if (isset($_GET['key']))
    $chave = $_GET['key'];
else
    $chave = null;

$date = date("Y-m-d");

$consulta = $pdo->query("SELECT * FROM recuperar_senha where chave = '$chave';");

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $email = $linha['email'];
    $data_chave = $linha['data'];
}

if($date > $data_chave){
    header("Location: linkexpirado.php");
}

?>

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
    <title>Atrupalhados - Nova Senha</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="main-wrapper">
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
            <div class="auth-box row">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(assets/images/foto_login.jpg);">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="assets/images/logo_trupe.jpg" alt="wrapkit" width="150px">
                        </div>
                        <form class="mt-4" id="dados_recuperar" method="POST">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Nova Senha</label>
                                        <input class="form-control" id="uname" type="password" name="senhanova" placeholder="Insira sua nova senha">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Confirmar Senha</label>
                                        <input class="form-control" id="pwd" type="password" name="confirmarsenha" placeholder="Confirme sua nova senha">
                                    </div>
                                </div>

                                <input type="hidden" name="email" value="<?php echo''.$email ?>">
                                <input type="hidden" name="chave" value="<?php echo''.$chave ?>">
                                <input type="hidden" name="funcao" value="alterar_senha_recuperar">

                                <div class="col-lg-12 text-center">
                                    <button type="button" class="btn btn-block btn-dark" id="button_recuperar">Confirmar</button>
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

<script>
    $(".preloader ").fadeOut();

    jQuery("#button_recuperar").click(function(){
		var data = $("#dados_recuperar").serialize();

  		$.ajax({
  			type : 'POST',
  			url  : 'functions.php',
  			data : data,
  			dataType: 'json',
            error: function()
            {
                $("#button_recuperar").html('Confirmar');
            },
            beforeSend: function()
            {
                $("#button_recuperar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Alterando...');
            },
            success: function(response){
                $("#button_recuperar").html('Confirmar');
                if($.trim(response) == 'campos_vazios'){
                    swal("Ops!", "Você deve preencher todos os campos!", "warning");
                } else if($.trim(response) == 'caracter_invalido'){
                    swal("Ops!", "Sua senha deve possuir de 8 à 16 caracteres!", "warning");
                } else if($.trim(response) == 'senhas_diferentes') {
                    swal("Ops!", "As senhas não conferem!", "warning");
                } else {
                    swal({
                        title: "Perfeito!",
                        text: "Senha alterada com sucesso!",
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
