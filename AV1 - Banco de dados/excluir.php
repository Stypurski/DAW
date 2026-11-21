<?php

header('Content-Type: application/json; charset=utf-8');
require_once "conexao.php";


if (isset($_GET["numero"])) {
  
    $id = (int)$_GET["numero"];

    $stmt = $pdo->prepare("DELETE FROM perguntas WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(["mensagem" => "Pergunta excluida"]);

  
}
  
?>
