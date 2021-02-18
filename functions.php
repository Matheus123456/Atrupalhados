<?php

include("conexao.php");

require 'assets/PHPMailer/PHPMailerAutoload.php';

ini_set('default_charset', 'utf-8');

date_default_timezone_set('America/Sao_Paulo');
$date = date("Y/m/d");


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

$funcao = $_POST['funcao'];

if($funcao == "listar_eventos"){
  $query = $pdo->query("SELECT * from events where date >= '$date' order by date;");

  while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $vetor[] = array_map('utf8_encode', $result);
  }

  echo json_encode($vetor);
}

if($funcao == "evento_modal_calendar"){
    $id = $_POST['id'];

    $query = $pdo->query("SELECT * from events where id = '$id';");
  
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      $vetor[] = array_map('utf8_encode', $result);
    }
  
    echo json_encode($vetor);
}

if($funcao == "listar_eventos_calendario"){
    $query = $pdo->query("SELECT * from events order by date;");
  
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      $vetor[] = array_map('utf8_encode', $result);
    }
  
    echo json_encode($vetor);
}

if($funcao == "cadastrar_evento"){
  $local = $_POST['local'];
  $data_evento = $_POST['data'];
  $endereco = $_POST['endereco'];
  $limite = $_POST['limite'];

  $data = [
      'data' => $data_evento,
      'local' => $local,
      'endereco' => $endereco,
      'qtd_pessoas' => $limite,
      'criador_evento' => $email
  ];

  if(empty($local)){
    echo json_encode("local_vazio");
  } else if(empty($data_evento)){
    echo json_encode("data_evento_vazio");
  } else if(empty($endereco)){
    echo json_encode("endereco_vazio");
  } else if(empty($limite)){
    echo json_encode("limite_vazio");
  } else {
    try {
        $stmt = $pdo->prepare('INSERT INTO events (nome_local, endereco, Qtd_pessoas, criador_evento, date)
        VALUES (:local, :endereco, :qtd_pessoas, :criador_evento, :data)');
        $stmt->execute($data);

        echo $stmt->rowCount();
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
  }
}

if($funcao == "verificar_presenca"){
    $id = $_POST['id'];

    $query = $pdo->query("SELECT eu.id, eu.email_user, eu.id_event, (SELECT count(*) from events_users where id_event = '$id') as qtd_pessoas 
    from events_users as eu
    where email_user = '$email' 
    and id_event = '$id';");

    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
        $vetor[] = array_map('utf8_encode', $result);
    }

    $query2 = $pdo->query("SELECT count(*) as qtd from events_users where id_event = '$id';");

    while ($result2 = $query2->fetch(PDO::FETCH_ASSOC)) {
        $vetor2[] = array_map('utf8_encode', $result2);
    }

    if(empty($vetor)){
      echo json_encode($vetor2);
    } else {
      echo json_encode($vetor);
    }

    //echo json_encode($vetor);
}

if($funcao == "confirmar_presenca"){
  $id = $_POST['id'];
  $limite_pessoas = $_POST['limite_pessoas'];
  $data = $_POST['data'];
  
  $consulta = $pdo->query("SELECT count(*) as qtd FROM events_users WHERE id_event = '$id';");
  
  while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $quant = $linha['qtd'];
  }

  if($quant == $limite_pessoas){
    echo json_encode("limite_atingido");
  } else {
      $data = [
        'email_user' => $email,
        'id' => $id,
        'data' => $data
    ];

    try {
        $stmt = $pdo->prepare('INSERT INTO events_users (email_user, id_event, data_evento)
        VALUES (:email_user, :id, :data)');
        $stmt->execute($data);

        echo $stmt->rowCount();
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
  }
}

if($funcao == "cancelar_presenca"){
  $id = $_POST['id'];

  //echo''.$id;
  //echo''.$email;

  $data = [
      'email_user' => $email,
      'id' => $id
  ];

  try {
      $stmt = $pdo->prepare('DELETE FROM events_users WHERE id_event = :id AND email_user = :email_user limit 1');
      $stmt->execute($data);

      echo $stmt->rowCount();
  } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
  }
}

if($funcao == "editar_evento"){
  $id = $_POST['id_evento_editar'];
  $local = $_POST['local_editar'];
  $data_evento = $_POST['data_editar'];
  $endereco = $_POST['endereco_editar'];
  $limite = $_POST['limite_editar'];
  $agora = new DateTime();
  $agora_format = $agora-> format('Y-m-d H:i');

  $data = [
      'id' => $id,
      'data' => $data_evento,
      'local' => $local,
      'endereco' => $endereco,
      'qtd_pessoas' => $limite
  ];

  $query = $pdo->query("SELECT count(*) as qtd FROM events_users WHERE id_event = '$id';");
  
  while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
    $quant = $linha['qtd'];
  }

  if(empty($local)){
    echo json_encode("local_vazio");
  } else if(empty($data_evento)){
    echo json_encode("data_evento_vazio");
  } else if($data_evento < $agora_format){
    echo json_encode("data_menor");
  } else if(empty($endereco)){
    echo json_encode("endereco_vazio");
  } else if(empty($limite)){
    echo json_encode("limite_vazio");
  } else if ($limite < $quant){
    echo json_encode("qtd_invalida");
  } else {
    try {
        $stmt = $pdo->prepare('UPDATE events SET nome_local = :local, endereco = :endereco, Qtd_pessoas = :qtd_pessoas, date = :data WHERE id = :id');
        $stmt->execute($data);

        echo $stmt->rowCount();
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
  }
}

if($funcao == "cancelar_evento"){
  $id = $_POST['id'];

  $data = ['id' => $id];

  try {
      $stmt = $pdo->prepare('DELETE FROM events WHERE id = :id limit 1');
      $stmt->execute($data);

      echo $stmt->rowCount();
  } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
  }
}

if($funcao == "listar_participantes"){
  $id = $_POST['id'];

  $query = $pdo->query("SELECT u.email, u.nome, u.foto FROM events_users as e
  Inner join users_app as u
  where u.email = e.email_user
  and e.id_event = '$id';");

  while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $vetor[] = array_map('utf8_encode', $result);
  }

  echo json_encode($vetor);
}

if($funcao == "cancelar_presenca_admin"){
  $id = $_POST['id'];
  $email = $_POST['email'];

  $data = [
    'id' => $id,
    'email' => $email
  ];

  try {
    $stmt = $pdo->prepare('DELETE FROM events_users WHERE id_event = :id and email_user = :email limit 1');
    $stmt->execute($data);

    echo $stmt->rowCount();
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
}

if($funcao == "alterar_senha"){
    require 'Usuario.class.php';
  
    $u = new alterar_senha_class();
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if(empty($senha_atual) || empty($nova_senha) || empty($confirmar_senha)){
      echo json_encode("campos_vazios");
    } else if (strlen($nova_senha) < 8 || strlen($nova_senha) > 16){
      echo json_encode("caracter_invalido");
    } else if($nova_senha != $confirmar_senha){
      echo json_encode("senhas_diferentes");
    } else if ($u->alterar_senha($email, $senha_atual) == false){
      echo json_encode("senha_incorreta");
    } else {
      //atualizar_senha($confirmar_senha);
  
      try {
        $data2 = [
          'senha_nova' => hash('sha512', $confirmar_senha),
          'email' => $email
        ];
  
        $altera_nova_senha = $pdo->prepare('UPDATE users_app SET senha = :senha_nova WHERE email = :email limit 1');
        $altera_nova_senha->execute($data2);
        echo json_encode('senha_alterada');
  
      } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
      }
    }
}

if($funcao == "alterar_usuario"){
    $nome = $_POST['nome'];
    $celular = $_POST['celular'];

    if(empty($nome) || empty($celular)){
      echo json_encode("campos_vazios");
    } else {
        try {
          $data2 = [
            'nome' => $nome,
            'celular' => $celular,
            'email' => $email
          ];
    
          $altera_usuario = $pdo->prepare('UPDATE users_app SET nome = :nome, celular = :celular WHERE email = :email limit 1');
          $altera_usuario->execute($data2);
          echo json_encode("alterado");
    
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }
    }
}

if($funcao == "listar_ultimos_eventos"){
  $query = $pdo->query("SELECT * FROM events_users as eu Inner Join events as e Where eu.id_event = e.id and eu.email_user = '$email' and e.date < '$date' limit 5;");

  while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $vetor[] = array_map('utf8_encode', $result);
  }

  echo json_encode($vetor);
}

if($funcao == "participantes_ultimos_eventos"){
  $id = $_POST['id'];
  $limite = $_POST['limite'];

  $query = $pdo->query("SELECT * FROM events_users as eu Inner Join users_app as u WHERE eu.email_user = u.email and eu.id_event = '$id' limit $limite;");

  while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $vetor[] = array_map('utf8_encode', $result);
  }

  echo json_encode($vetor);
}

if($funcao == "listar_usuarios"){
  $query = $pdo->query("SELECT * from users_app where acesso = 's';");

  while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $vetor[] = array_map('utf8_encode', $result);
  }

  echo json_encode($vetor);
}

if($funcao == "tornar_admin"){
    $email_key = $_POST['email'];
    
    $data = [
        'email_user' => $email_key,
        'tipo_conta' => 'admin'
    ];
    
    try {
        $stmt = $pdo->prepare('UPDATE users_app SET tipo_conta = :tipo_conta WHERE email = :email_user limit 1');
        $stmt->execute($data);

        echo $stmt->rowCount();
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

if($funcao == "cancelar_admin"){
    $email_key = $_POST['email'];
    
    $data = [
        'email_user' => $email_key,
        'tipo_conta' => 'user'
    ];
    
    try {
        $stmt = $pdo->prepare('UPDATE users_app SET tipo_conta = :tipo_conta WHERE email = :email_user limit 1');
        $stmt->execute($data);

        echo $stmt->rowCount();
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

if($funcao == "excluir_usuário"){
    $email_key = $_POST['email'];
  
    $data = [
        'email_user' => $email_key
    ];
  
    try {
        $stmt = $pdo->prepare('DELETE FROM users_app WHERE email = :email_user limit 1');
        $stmt->execute($data);
  
        echo $stmt->rowCount();
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

if($funcao == "cancelar_acesso"){
    $email_key = $_POST['email'];
    
    $data = [
        'email_user' => $email_key,
        'acesso' => 'n'
    ];
    
    try {
        $stmt = $pdo->prepare('UPDATE users_app SET acesso = :acesso WHERE email = :email_user limit 1');
        $stmt->execute($data);

        echo $stmt->rowCount();
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

if($funcao == "conceder_acesso"){
  $email_key = $_POST['email'];
  
  $data = [
      'email_user' => $email_key,
      'acesso' => 's'
  ];
  
  try {
      $stmt = $pdo->prepare('UPDATE users_app SET acesso = :acesso WHERE email = :email_user limit 1');
      $stmt->execute($data);

      echo $stmt->rowCount();
  } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
  }
}

if($funcao == "cadastrar_usuario"){
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $celular = $_POST['celular'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirmasenha'];
    
    $data = [
        'email' => $email,
        'nome' => $nome,
        'celular' => $celular,
        'confirma_senha' => hash('sha512', $confirma_senha),
        'tipo_conta' => 'user',
        'foto' => 'default.png',
        'acesso' => 'n'
    ];

    if(empty($email)){
      echo json_encode("email_vazio");
    } else if(empty($nome)){
      echo json_encode("nome_vazio");
    } else if(strlen($celular) < 15){
      echo json_encode("celular_vazio");
    } else if(empty($senha)){
        echo json_encode("senha_vazio");
    } else if(empty($confirma_senha)){
        echo json_encode("confirmarsenha_vazio");
    } else if (strlen($senha) < 8 || strlen($confirma_senha) > 16){
        echo json_encode("caracter_invalido");
    } else if($senha != $confirma_senha){
        echo json_encode("senhas_diferentes");
    } else {
      try {
          $stmt = $pdo->prepare('INSERT INTO users_app (email, senha, nome, celular, tipo_conta, foto, acesso) VALUES (:email, :confirma_senha, :nome, :celular, :tipo_conta, :foto, :acesso)');
          $stmt->execute($data);
  
          echo $stmt->rowCount();
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }
    }
}

if($funcao == "verificar_email"){
    $email = $_POST['email'];

    $select = $pdo->query("SELECT * FROM users_app where email = '$email';")->fetchAll();
    $count = count($select);
    echo json_encode($count);
}

if($funcao == "recuperar_senha"){
    $email = $_POST['email'];

    function randString($size){
      $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      $return= "";
  
      for($count= 0; $size > $count; $count++)
      {
        $return.= $basic[rand(0, strlen($basic) - 1)];
      }
      return $return;
    }

    $chave = randString(60);

    $data = [
        'email' => $email,
        'chave' => $chave,
        'data' => $date
    ];

    try{
        $stmt = $pdo->prepare('INSERT INTO recuperar_senha (email, chave, data) Values (:email, :chave, :data);');
        $stmt->execute($data);

        } catch(PDOException $e) {
    }

    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->From = "atrupalhados@atrupalhados.com.br";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.hostinger.com.br";
    $mail->Port = 587;
    $mail->Username ='atrupalhados@atrupalhados.com.br';
    $mail->Password = 'Killer@123';
    $mail->setFrom('atrupalhados@atrupalhados.com.br', 'Contato | Atrupalhados');

    $msg = utf8_decode("Olá, Você solicitou a redefinição da sua senha.\r\n\r\n <a href='http://new.atrupalhados.com.br/redefinir_senha.php?key=$chave'>Clique aqui</a> para redefinir sua senha. \r\n\r\n");

    $mail->AddAddress($email);
    $mail->Subject = utf8_decode("Não Responda | Atrupalhados");
    $mail->IsHTML(true);
    $mail->Body = $msg;
  
    if($mail->Send()){
      echo json_encode('success');
    } else {
        echo json_encode('error');
    }

}

if($funcao == "alterar_senha_recuperar"){
    $senhanova = $_POST['senhanova'];
    $confirma_senha = $_POST['confirmarsenha'];
    $email = $_POST['email'];
    $chave = $_POST['chave'];

    //echo''.$senhanova;
    //echo'<br>'.$confirma_senha;

    $data = [
        'email' => $email,
        'confirma_senha' => hash('sha512', $confirma_senha)
    ];
    
    if(empty($senhanova) || empty($confirma_senha)){
        echo json_encode("campos_vazios");
    } else if (strlen($senhanova) < 8 || strlen($senhanova) > 16){
        echo json_encode("caracter_invalido");
    } else if($senhanova != $confirma_senha){
        echo json_encode("senhas_diferentes");
    } else {
        try {
            $stmt = $pdo->prepare('UPDATE users_app SET senha = :confirma_senha WHERE email = :email limit 1');
            $stmt->execute($data);
      
            echo $stmt->rowCount();
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

if($funcao == "ranking_mes"){
    $query = $pdo->query("SELECT eu.id, u.nome, u.foto, eu.email_user, eu.id_event, eu.data_evento, count(eu.email_user) as qtd FROM events_users as eu
    Inner Join users_app as u WHERE eu.email_user = u.email AND MONTH(data_evento) = MONTH(CURRENT_DATE()) AND YEAR(data_evento) = YEAR(CURRENT_DATE())
    GROUP BY email_user order by qtd DESC;");

    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
      $vetor[] = array_map('utf8_encode', $result);
    }
  
    echo json_encode($vetor);
}

if($funcao == "ranking_ano"){
  $query = $pdo->query("SELECT eu.id, u.nome, u.foto, eu.email_user, eu.id_event, eu.data_evento, count(eu.email_user) as qtd FROM events_users as eu
  Inner Join users_app as u WHERE eu.email_user = u.email AND YEAR(data_evento) = YEAR(CURRENT_DATE())
  GROUP BY email_user order by qtd DESC;");

  while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $vetor[] = array_map('utf8_encode', $result);
  }

  echo json_encode($vetor);
}

if($funcao == "ranking_total"){
  $query = $pdo->query("SELECT eu.id, u.nome, u.foto, eu.email_user, eu.id_event, eu.data_evento, count(eu.email_user) as qtd FROM events_users as eu
  Inner Join users_app as u WHERE eu.email_user = u.email GROUP BY email_user order by qtd DESC;");

  while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $vetor[] = array_map('utf8_encode', $result);
  }

  echo json_encode($vetor);
}

if($funcao == "listar_usuarios_dashboard"){
  $query = $pdo->query("SELECT * from users_app where acesso = 's' order by nome;");

  while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
    $vetor[] = array_map('utf8_encode', $result);
  }

  echo json_encode($vetor);
}

if($funcao == "contar_participacoes"){
    $email = $_POST['email'];

    $select = $pdo->query("SELECT * FROM events_users where email_user = '$email';")->fetchAll();
    $count = count($select);

    echo json_encode('2');
}

if($funcao == "alterar_foto"){

	$data = $_POST["image"];

    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $data = base64_decode($image_array_2[1]);
    $id_unique = md5(uniqid(time()));

	$imageName = 'assets/images/fotos/'.$id_unique. '.png';

	file_put_contents($imageName, $data);
    //echo''.$imageName;
    
    $data = [
        'email' => $email,
        'foto' => $id_unique.'.png'
    ];

    try {
        $stmt = $pdo->prepare('UPDATE users_app SET foto = :foto WHERE email = :email');
        $stmt->execute($data);

        //echo $stmt->rowCount();
        echo $id_unique.'.png';
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}



  


