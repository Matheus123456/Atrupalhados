<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo-bobo.png">
    <title>Perfil</title>

    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

    <link href="dist/css/style.min.css" rel="stylesheet">
	<link rel="stylesheet" href="dist/css/croppie.css" />
</head>

<body>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
    <?php include("header.php"); ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Perfil</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Início</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Perfil</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
     
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 text-center col-md-6">
                        <div class="card">
                            <div class="card-body" style="padding-left: 25px; padding-right: 25px; padding-top: 25px; padding-bottom: 0px;">
                                <img src="assets/images/fotos/<?php echo''.$foto; ?>" alt="image" class="rounded-circle foto_perfil" width="200px">
                                <p class="mt-3 mb-0"></p>
                                <h4 class="card-title" id="nome_title"><?php echo''.$nome ?></h4>
                            </div>

                            <center>
                                <div class="input-group" style="width: 95%; margin-top: 20px;">
                                    <input type="text" class="form-control field_image" readonly>
                                    <label class="input-group-btn" style="height: 15px;">
                                        <span class="btn btn-primary">
                                            Escolher&hellip; <input type="file" name="upload_image" id="upload_image" style="display: none;" accept="image/png, image/jpeg" />
                                        </span>
                                    </label>
                                </div>
                                <span class="help-block">
                            </center>

                            <hr>

                            <div class="text-left" style="margin-left: 12px;">
                                <label style="font-size: 11px;">Endereço de Email</label>
                                <h6 class="card-title"><?php echo''.$email ?></h6>
                            </div>

                            <div class="text-left" style="margin-left: 12px; margin-bottom: 20px;">
                                <label style="font-size: 11px;">Celular</label>
                                <h6 class="card-title" id="celular_title"><?php echo''.$celular; ?></h6>
                            </div>
                        </div>
                    </div>   
                
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <h4 class="card-title mb-0">Editar Perfil</h4>  
                                </div><br>

                                <form method="POST" id="alterar_dados">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nome" id="nome_val" placeholder="Nome Completo" value="<?php echo''.$nome ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" placeholder="Endereço de Email" value="<?php echo''.$email ?>" readonly>
                                    </div>
                                
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="celular" id="celular_val" placeholder="Celular" value="<?php echo''.$celular ?>">
                                    </div>
                                
                                    <input type="hidden" name="funcao" value="alterar_usuario">

                                    <button type="button" id="button_atualizar" onclick="alterar_usuario()" class="btn waves-effect waves-light btn-success profile-button">Atualizar Perfil</button>
                                </form>
                            </div>
                        </div>
                    </div>  
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" id="form_alterar_senha">
                                    <div class="d-flex align-items-start" style="margin-bottom: 20px;">
                                        <h4 class="card-title mb-0">Alterar Senha</h4>  
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" name="senha_atual" placeholder="Senha Atual">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" name="nova_senha" placeholder="Senha">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" name="confirmar_senha" placeholder="Confirmar Senha">
                                    </div>

                                    <input type="hidden" name="funcao" value="alterar_senha">

                                    <button type="button" id="btn_altera_senha" onclick="alterar_senha()" class="btn waves-effect waves-light btn-primary pass-button">Alterar Senha</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Ultimos Eventos</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0 font-14 font-weight-medium text-muted">Local</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Endereço</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Participantes</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted text-center">Data</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ultimos_eventos_table">
                                            <!--<tr>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Hospital Salgado Filho</h5>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14">2021-01-30 23:14:00</td>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="popover-icon">
                                                        <a class="" style=""><img src="assets/images/fotos/b89226b4e4596d9bf273ded5719b8f0b.jpg" style="width: 50px; border-radius: 100px;"></a>
                                                        <a class="" style=""><img src="assets/images/fotos/b89226b4e4596d9bf273ded5719b8f0b.jpg" style="width: 50px; border-radius: 100px;"></a>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-center px-2 py-4">2021-01-30 23:14:00</td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="participantes_modal" class="modal fade" tabindex="-1" role="dialog" style="display: none; padding-right: 0px;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-body info-modal" style="">
                                <div class="text-center mt-2 mb-4">
                                    <h3>Participantes</h3>
                                </div>

                                <form class="pl-3 pr-3" method="POST">
                                    <div class="row">
                                        <div class="col-12" style="padding-left: 7px;">
                                            <div class="card" style="box-shadow: 0px 0px 0px 0 rgba(0,0,0,0);">
                                                <div class="card-body" style="padding: 0px;">
                                                    <div class="table-responsive">
                                                        <table class="table no-wrap v-middle mb-0">
                                                            <tbody id="part_modal">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="uploadimageModal" class="modal" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row" style="display: block;">
                                    <div class="text-center">
                                        <center><div id="image_demo" style="width:475px; margin-top:30px"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <button class="btn btn-success crop_image">Cortar e Atualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer text-center text-muted">
                All Rights Reserved by Adminmart. Designed and Developed by <a
                    href="https://wrappixel.com">WrapPixel</a>.
            </footer>
        </div>
 
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="dist/js/pages/dashboards/dashboard1.min.js"></script>
    <script src="dist/js/functions.js"></script>
    <script src="dist/js/croppie.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script> listar_ultimo_eventos(); </script>
    <script language="javascript"> 
        var email_usuario = "<?php print $email; ?>"; 
        var tipo_conta = "<?php print $tipo_conta; ?>";
    </script>
    
</body>

<script>

jQuery('#celular_val').mask('(99) 99999-9999');


$(document).ready(function(){

    $image_crop = $('#image_demo').croppie(
        {
            enableExif: true,
            viewport: {
            width:200,
            height:200,
            type:'Square' //Square
        },
        boundary:{
            width:400,
            height:400
        }
    });

$('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
    $image_crop.croppie('bind', {
        url: event.target.result
        
    }).then(function(){
        console.log('jQuery bind complete');
    });
}
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
});

$('.crop_image').click(function(event){
    $image_crop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
    }).then(function(response){
        $.ajax({
            url:"functions.php",
            type: "POST",
            data:{"image": response, "funcao": 'alterar_foto'},
            success:function(result)
            {
                var foto = $.trim(result);
                $('#uploadimageModal').modal('hide');
                location.reload();
            }
        });
        })
    });
});  



jQuery(function() {

    jQuery(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
    });

    jQuery(document).ready( function() {
        $(':file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }

        });
    });
});


</script>

<style>

.card-title{
    color: #3e5569!important;
}

@media (max-width: 768px) {
    .profile-button{
        width: 100%;
    }
    .pass-button{
        width: 100%;
    }
}

</style>
</html>
