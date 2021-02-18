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
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Calendário</title>
    <!-- Custom CSS -->
    <link href="assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>
 
    <!--<div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>-->

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
    <?php include("header.php"); ?>
        <div class="page-wrapper">
      
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Calendário</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Início</li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">Calendário</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--<div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Aug 19</option>
                                <option value="1">July 19</option>
                                <option value="2">Jun 19</option>
                            </select>
                        </div>
                    </div>-->
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body b-l calender-sidebar">
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer text-center">
                All Rights Reserved by Adminmart. Designed and Developed by <a
                    href="https://wrappixel.com">WrapPixel</a>.
            </footer>
           
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
    </div>
    
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/extra-libs/taskboard/js/jquery.ui.touch-punch-improved.js"></script>
    <script src="assets/extra-libs/taskboard/js/jquery-ui.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <script src="assets/libs/moment/min/moment.min.js"></script>
    <script src="assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="dist/js/pages/calendar/cal-init.js"></script>
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

</style>

</html>