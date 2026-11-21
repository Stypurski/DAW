<?php

header('Content-Type: application/json; charset=utf-8');
require_once "conexao.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  
    $id = (int)($_POST["index"] ?? 0);
    $nome = $_POST["nome"] ?? "";
    $email = $_POST["email"] ?? "";

    $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $id]);

    echo json_encode(["mensagem" => "Usuário atualizado com sucesso!"]);

  
}
  
?>
