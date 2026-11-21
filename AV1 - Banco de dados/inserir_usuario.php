<?php


header('Content-Type: application/json; charset=utf-8');
require_once "conexao.php";


if($_SERVER['REQUEST_METHOD'] === 'POST'){
  
    $nome  = $_POST["nome"] ?? "";
    $email = $_POST["email"] ?? "";

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (?, ?)");
    $stmt->execute([$nome, $email]);

    echo json_encode(["mensagem" => "Usuário cadastrado"]);
  
}
  
?>
