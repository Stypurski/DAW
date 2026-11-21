<?php

header('Content-Type: application/json; charset=utf-8');
require_once "conexao.php";

$stmt= $pdo->query("SELECT id, nome, email FROM usuarios ORDER BY id ASC");
$resultados = $stmt->fetchAll();

$lista = [];

foreach($resultados as $row){
  
    $lista[] = ["index" => (int)$row["id"], "nome"  => $row["nome"], "email" => $row["email"]];
  
}

echo json_encode($lista);

?>
