<?php

$mes_atual = date("m"); 

switch (date("m")) {
        case "01":    $mes = Janeiro;     break;
        case "02":    $mes = Fevereiro;   break;
        case "03":    $mes = Março;       break;
        case "04":    $mes = Abril;       break;
        case "05":    $mes = Maio;        break;
        case "06":    $mes = Junho;       break;
        case "07":    $mes = Julho;       break;
        case "08":    $mes = Agosto;      break;
        case "09":    $mes = Setembro;    break;
        case "10":    $mes = Outubro;     break;
        case "11":    $mes = Novembro;    break;
        case "12":    $mes = Dezembro;    break; 
 }

?>

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
    <title>Inicio</title>

    <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php include("header.php"); ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Olá, <?php echo''.$nome; ?>!</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.php">Início</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            
            <?php

            $select_events = $pdo->prepare('SELECT * FROM events');
            $select_events->execute();
            $count_events = $select_events->rowCount();

            $select_events_month = $pdo->prepare('SELECT * FROM events where MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE())');
            $select_events_month->execute();
            $count_events_month = $select_events_month->rowCount();

            $select_users = $pdo->prepare('SELECT * FROM users_app');
            $select_users->execute();
            $count_users = $select_users->rowCount();

            $select_admins = $pdo->prepare('SELECT * FROM users_app where tipo_conta = "admin" or tipo_conta = "adminmaster";');
            $select_admins->execute();
            $count_admins = $select_admins->rowCount();

            ?>

            <div class="container-fluid">
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo''.$count_events; ?></h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total de Eventos</h6>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><?php echo''.$count_events_month; ?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total de eventos (mês atual)
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?php echo''.$count_users; ?></h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total de Usuários</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><?php echo''.$count_admins; ?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total de administradores</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Ranking de <?php echo''.$mes; ?></h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0" style="text-align: center;">
                                                <th class="border-0 font-14 font-weight-medium text-muted">Usuário</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Posição</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Participações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_rank_mes">
                                        
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-light" style="margin-bottom: 10px; margin-top: 10px;" onclick="ranking_mes();">Carregar Mais</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Ranking de <?php echo date("Y"); ?></h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0" style="text-align: center;">
                                                <th class="border-0 font-14 font-weight-medium text-muted">Usuário</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Posição</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Participações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_rank_ano">
                                        
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-light" style="margin-bottom: 10px; margin-top: 10px;" onclick="ranking_ano();">Carregar Mais</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Ranking Total</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0">
                                            <th class="border-0 font-14 font-weight-medium text-muted">Usuário</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Posição</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Participações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_rank_total">
                                        
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-light" style="margin-bottom: 10px; margin-top: 10px;" onclick="ranking_total();">Carregar Mais</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Usuários</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0 font-14 font-weight-medium text-muted">Usuário</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Contato</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted text-center">Participações total</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Tipo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="usuarios_dashboard">
                                            
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-light" style="margin-bottom: 10px; margin-top: 10px;" onclick="listar_todos_usuarios();">Ver mais usuários</button>
                                    </div>
                                </div>
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
    
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>

    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="dist/js/pages/dashboards/dashboard1.min.js"></script>
    <script src="dist/js/functions.js"></script>
    <script> 
        ranking_mes();
        ranking_ano();
        ranking_total();
        listar_todos_usuarios();
    </script>
</body>

<style>

.icon{
    font-size: 17px;
    margin-top: -2px;
}

</style>
</html>

