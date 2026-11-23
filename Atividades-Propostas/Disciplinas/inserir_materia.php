<?php


header('Content-Type: application/json; charset=utf-8');
require_once "conexao.php";


if($_SERVER['REQUEST_METHOD'] === 'POST'){
  
    $nome  = $_POST["nome"] ?? "";
    $sigla = $_POST["sigla"] ?? "";
    $carga = $_POST["carga"] ?? "";

    $stmt = $pdo->prepare("INSERT INTO materias (nome, sigla, carga) VALUES (?, ?.,?)");
    $stmt->execute([$nome, $sgila, $carga]);

    echo json_encode(["mensagem" => "Materia cadastrada"]);
  
}
  
?>
