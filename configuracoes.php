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
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Configurações</title>
    <!-- This page plugin CSS -->
    <link href="assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <?php include('header.php'); ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Configurações</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.php" class="text-muted">Início</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Configurações</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                   
                </div>
            </div>
           
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2>Usuários</h2><br>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th style="width: 200px;">Nome</th>
                                                <th style="width: 150px;">Celular</th>
                                                <th>Email</th>
                                                <th>Tipo</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="usuarios_table">
                                        <?php

                                        while ($linha = $dados_usuario->fetch(PDO::FETCH_ASSOC)) {
                                            if($linha['acesso'] == 's'){
                                                $acesso = 'Permitido';
                                            } else {
                                                $acesso = 'N';
                                            }

                                            if($linha['tipo_conta'] == "user"){
                                                $conta = 'Usuário';
                                            } else if ($linha['tipo_conta'] == "admin"){
                                                $conta = 'Administrador';
                                            } else {
                                                $conta = 'ADM Master';
                                            }

                                            $email_user = $linha['email'];

                                            echo"<tr>
                                                    <td>".$linha['nome']."</td>
                                                    <td>".$linha['celular']."</td>
                                                    <td>".$email_user."</td>
                                                    <td>".$conta."</td>
                                                    <td class='text-center'>
                                                        <div class='btn-group dropleft'>
                                                            <button type='button' class='btn btn-success dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                                                                <i class='fas fa-bars'></i>&nbsp Ações
                                                            </button>
                                                            <div class='dropdown-menu' x-placement='bottom-start' style='position: absolute; will-change: transform; top: 0px; left: -29px; transform: translate3d(0px, 38px, 0px);'>
                                                                <a class='dropdown-item' id=".$email_user." href='#' onclick='cancelar_acesso(this.id)'>Cancelar Acesso</a>";
                                                                
                                                                if($tipo_conta == "adminmaster" && $linha['tipo_conta'] == "user"){
                                                                    echo"<a class='dropdown-item' id=".$email_user." href='#' onclick='tornar_admin(this.id)'>Tornar Administrador</a>";
                                                                } else if($tipo_conta == "adminmaster" && $linha['tipo_conta'] == "admin"){
                                                                    echo"<a class='dropdown-item' id=".$email_user." href='#' onclick='cancelar_admin(this.id)'>Cancelar Administrador</a>";
                                                                }
                                                                echo"
                                                                <div class='dropdown-divider'></div>
                                                                <a class='dropdown-item' id=".$email_user." href='#' onclick='excluir_usuário(this.id)'>Excluir Usuário</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>";
                                        }
                                        ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2>Usuários</h2><br>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Celular</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="usuarios_table2">
                                        <?php

                                        while ($linha2 = $dados_usuario_unaccess->fetch(PDO::FETCH_ASSOC)) {
                                            $email_user2 = $linha2['email'];

                                            echo"<tr>
                                                    <td>".$linha2['nome']."</td>
                                                    <td>".$linha2['email']."</td>
                                                    <td>".$linha2['celular']."</td>
                                                    <td class='text-center'><button type='button' id=".$email_user2." class='btn waves-effect waves-light btn-success' onclick='conceder_acesso(this.id)'>Conceder acesso</button></td>
                                                </tr>";
                                        }
                                        ?> 
                                        </tbody>
                                    </table>
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
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/pages/datatable/datatable-basic.init.js"></script>
    <script src="dist/js/functions.js"></script>

    <style>

    .dropleft .dropdown-toggle::before {
        display: none;
    }

    .table-bordered, .table-bordered td, .table-bordered th{
        border: 0px solid #e8eef3;
        text-align: center;
    }

    </style>

</body>

</html>