<?php
  include('conexao.php');

  if(!isset($_SESSION['emailUser'])){
    header("Location: login.php");
    exit;
  }

  $email_usuario = $_SESSION['emailUser'];
  $consulta = $pdo->query("SELECT * FROM users_app where email = '$email_usuario';");

  while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
      $email = $linha['email'];
      $nome = $linha['nome'];
      $celular = $linha['celular'];
      $tipo_conta = $linha['tipo_conta'];
      $foto = $linha['foto'];
      $acesso = $linha['acesso'];
  }

    $nome_pagina = basename($_SERVER['PHP_SELF'],'.php');

    if($nome_pagina == 'index'){
        $active_inicio = "select";
    } else if($nome_pagina == 'eventos'){
        $active_eventos = "selected";
    } else if($nome_pagina == 'calendario'){
        $active_calendario = "select";
    } else if($nome_pagina == 'perfil'){
        $active_perfil = "select";
    }

    $numero_index = explode("", $celular);
    $ddd = $numero_index[0]+$numero_index[1];

    $dados_usuario = $pdo->query("SELECT * from users_app where acesso = 's' and tipo_conta != 'adminmaster';");
    $dados_usuario_unaccess = $pdo->query("SELECT * from users_app where acesso = 'n';");

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <div class="navbar-brand">
                <!-- Logo icon -->
                <a href="index.php">
                    <b class="logo-icon">
                        <img src="assets/images/logo-bobo.png" alt="homepage" class="dark-logo" />
                    </b>
                    <span class="logo-text">
                        <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                    </span>
                </a>
            </div>

            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav float-left mr-auto ml-3 pl-1">

            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img src="assets/images/fotos/<?php echo''.$foto; ?>" alt="user" class="rounded-circle" width="40">
                        <span class="ml-2 d-none d-lg-inline-block">
                          <span class="text-dark"><?php echo''.$nome; ?></span>
                          <i data-feather="chevron-down" class="svg-icon"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i data-feather="user" class="svg-icon mr-2 ml-1"></i>
                            My Profile
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)"><i data-feather="credit-card" class="svg-icon mr-2 ml-1"></i>
                            My Balance
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)"><i data-feather="mail" class="svg-icon mr-2 ml-1"></i>
                            Inbox
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)"><i data-feather="settings" class="svg-icon mr-2 ml-1"></i>
                            Account Setting
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)"><i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                            Logout
                        </a>
                        <div class="dropdown-divider"></div>
                        <div class="pl-4 p-3"><a href="javascript:void(0)" class="btn btn-sm btn-info">View Profile</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item <?php echo''.$active_inicio; ?>">
                  <a class="sidebar-link sidebar-link" href="index.php" aria-expanded="false">
                    <i class="icon-home icon"></i>
                    <span class="hide-menu">Início</span>
                  </a>
                </li>

                <li class="sidebar-item <?php echo''.$active_eventos; ?>">
                  <a class="sidebar-link" href="eventos.php" aria-expanded="false">
                    <i class="icon-list icon"></i>
                    <span class="hide-menu">Eventos</span>
                  </a>
                </li>

                <li class="sidebar-item <?php echo''.$active_calendario; ?>">
                  <a class="sidebar-link sidebar-link" href="calendario.php" aria-expanded="false">
                    <i class="icon-calender icon"></i>
                    <span class="hide-menu">Calendário</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link sidebar-link" href="perfil.php" aria-expanded="false">
                    <i class="icon-user icon"></i>
                    <span class="hide-menu">Perfil</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link sidebar-link" href="configuracoes.php" aria-expanded="false">
                    <i class="icon-settings icon"></i>
                    <span class="hide-menu">Configurações</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link sidebar-link" href="session_destroy.php" aria-expanded="false">
                    <i class="icon-logout icon"></i>
                    <span class="hide-menu">Sair</span>
                  </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
