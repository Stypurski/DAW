<?php

header('Content-Type: application/json; charset=utf-8');
require_once "conexao.php";

if(isset($_GET["excluir"])){
  
    $id = (int)$_GET["excluir"];

    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(["mensagem" => "Usuario excluido"]);
  
}
  
?>
  
