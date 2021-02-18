<?php

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha']))
{
  require 'conexao.php';
  require 'Usuario.class.php';

  $u = new Usuario();
  $email = addslashes($_POST['email']);
  $senha = addslashes($_POST['senha']);

  $result = $u->login($email, $senha);

  if($result == 'sem_acesso'){
    echo json_encode("sem_acesso");
  } else if($result == 'ok'){
    echo json_encode("entrou");
  } else {
    echo json_encode("incorreto");
  }
} else {
  echo json_encode("vazio");
}

?>
