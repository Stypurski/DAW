<?php

$host    = "localhost";
$banco   = "sr_waterfalls";
$usuario = "root";
$senha   = "";


try{
  
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}catch(PDOException $e){
  
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(500);
    echo json_encode(["mensagem" => "Erro na conexão com o banco: " . $e->getMessage()]);
    exit;
  
}

  
?>
