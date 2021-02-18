<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo-bobo.png">
    <title>Eventos</title>
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- This Page CSS -->
    <link rel="stylesheet" type="text/css" href="assets/extra-libs/prism/prism.css">
</head>

<body>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <?php include("header.php"); ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Próximos Eventos</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Início</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Eventos</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <?php if($tipo_conta != 'user') {?>
                                <button type="button" class="btn waves-effect waves-light btn-lg btn-success button-criar-evento" data-toggle="modal" data-target="#signup-modal"> + Criar Evento</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row" id="eventos-row">

                </div>
            </div>

            <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none; padding-right: 0px;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body">
                            <div class="text-center mt-2 mb-4">
                                <h3>Cadastrar Evento</h3>
                            </div>

                            <form class="pl-3 pr-3" method="POST" id="cadastrar_evento">

                                <div class="form-group">
                                    <label>Local</label>
                                    <input class="form-control" type="text" name="local" placeholder="Hospital Salgado Filho">
                                </div>

                                <div class="form-group">
                                    <label>Data</label>
                                    <input class="form-control" type="datetime-local" name="data">
                                </div>

                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input class="form-control" type="text" name="endereco" placeholder="Endereço">
                                </div>

                                <div class="form-group">
                                    <label>Limite de participantes</label>
                                    <input class="form-control" type="text" name="limite" placeholder="0">
                                </div>

                                <input type="hidden" name="funcao" value="cadastrar_evento">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            <button class="btn btn-success" type="button" id="button_cadastrar" onclick="cadastrar_evento();">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="editar-evento" class="modal fade" tabindex="-1" role="dialog" style="display: none; padding-right: 0px;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body">
                            <div class="text-center mt-2 mb-4">
                                <h3>Editar Evento</h3>
                            </div>

                            <form class="pl-3 pr-3" method="POST" id="editar_evento">

                                <div class="form-group">
                                    <label>Local</label>
                                    <input class="form-control" type="text" name="local_editar" id="local_editar" placeholder="Hospital Salgado Filho">
                                </div>

                                <div class="form-group">
                                    <label>Data</label>
                                    <input class="form-control" type="datetime-local" name="data_editar" id="data_editar">
                                </div>

                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input class="form-control" type="text" name="endereco_editar" placeholder="Endereço" id="endereco_editar">
                                </div>

                                <div class="form-group">
                                    <label>Limite de participantes</label>
                                    <input class="form-control" type="text" name="limite_editar" placeholder="0" id="limite_editar">
                                </div>

                                <input type="hidden" name="funcao" value="editar_evento">
                                <input type="hidden" name="id_evento_editar" id="id_evento_editar" value="">

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            <button class="btn btn-success" type="button" id="button_editar" onclick="editar_evento();">Editar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="info-evento" class="modal fade" tabindex="-1" role="dialog" style="display: none; padding-right: 0px;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body info-modal" style="">
                            <div class="text-center mt-2 mb-4">
                                <h3>Informações do Evento</h3>
                            </div>

                            <form class="pl-3 pr-3" method="POST">
                                <label class="label_info">Local: </label> <a class="local_info info">Teste</a><br>
                            
                                <label class="label_info">Endereço: </label> <a class="endereco_info info">Teste</a><br>
                            
                                <label class="label_info">Data: </label> <a class="data_info info">Teste</a><br>
                            
                                <label class="label_info">Limite de participantes: </label> <a class="limite_info info">Teste</a><br><br>

                                <!--<label class="label_info">Criador do evento: </label> <a class="criador_evento_info info">Teste</a><br><br>-->

                                <label class="label_info">Lista de participantes (<a id="qtd_part"></a>): </label> <a class="info"></a><br>

                                <div class="row">
                                    <div class="col-12" style="padding-left: 7px;">
                                        <div class="card" style="box-shadow: 0px 0px 0px 0 rgba(0,0,0,0);">
                                            <div class="card-body" style="padding: 0px;">
                                                <div class="table-responsive">
                                                    <table class="table no-wrap v-middle mb-0">
                                                        <tbody id="part_table"><br>
                                                            
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

            <footer class="footer text-center text-muted">
                All Rights Reserved by Adminmart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/functions.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <script src="assets/extra-libs/prism/prism.js"></script>
    <script> listar_eventos(); </script>
    <script language="javascript"> 
        var email_usuario = "<?php print $email; ?>"; 
        var tipo_conta = "<?php print $tipo_conta; ?>";
    </script>

</body>

<style>

.info{
    color: black!important;
}

.pb-4, .py-4 {
    padding-top: 0rem!important;
}

@media (max-width: 507px) {
  .col-7{
    display: none;
  }

  .col-5{
    flex: 0 0 100%;
    max-width: 100%;
  }

  .customize-input {
    width: 100%;
  }

  .button-criar-evento{
    width: 100%;
  }

  .info-modal{
    padding: 0rem; 
    padding-top: 20px;
  }
}

@media (max-width: 796px) {
  .btn-confirmar{
      width: 100%;
  }

  .btn-vermais{
      width: 100%;
      margin-top: 10px;
  }
}

@media (min-width:992px) and (max-width: 1169px) {
  .btn-confirmar{
      width: 200px;
  }

  .btn-vermais{
      width: 200px;
      margin-top: 10px;
  }
}

@media (min-width:1170px) and (max-width: 1335px) {
  .btn-confirmar{
      width: 200px;
  }

  .btn-vermais{
      width: 200px;
      margin-top: 10px;
  }
}

</style>

</html>
