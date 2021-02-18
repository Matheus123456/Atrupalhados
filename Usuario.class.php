<?php

class Usuario {
  public function login($email, $senha){
    global $pdo;

    $sql = "SELECT * FROM users_app where email = :email AND senha = :senha";
    $sql = $pdo->prepare($sql);
    $sql->bindValue("email", $email);
    $sql->bindValue("senha", hash('sha512', $senha));
    $sql->execute();

    /*$dados_usuario_unaccess = $pdo->query("SELECT * from users_app where acesso = 'n';");
    while ($linha = $dados_usuario->fetch(PDO::FETCH_ASSOC)) {

    }*/
    $dado = $sql->fetch();

    if($dado['acesso'] == 'n'){
        return 'sem_acesso';
      } else if($sql->rowCount() > 0){
        $_SESSION['emailUser'] = $dado['email'];
        return 'ok';
      } else {
        return 'erro';
      }
    }
}

class alterar_senha_class {
  public function alterar_senha($email, $senha){
    global $pdo;

    $sql = "SELECT * FROM users_app where email = :email AND senha = :senha";
    $sql = $pdo->prepare($sql);
    $sql->bindValue("email", $email);
    $sql->bindValue("senha", hash('sha512', $senha));
    $sql->execute();

    if($sql->rowCount() > 0){
      return true;
    } else {
      return false;
    }
  }
}

?>