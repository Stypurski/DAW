<?php

header('Content-Type: application/json; charset=utf-8');
require_once "conexao.php";


if($_SERVER['REQUEST_METHOD'] === 'POST'){
  
    $tipo= $_POST["tipo"] ?? "multipla";
    $pergunta = $_POST["pergunta"] ?? "";
    $resposta = $_POST["resposta"] ?? "";

  
    $opA = ($tipo === "multipla") ? ($_POST["opcoesA"] ?? null) : null;
    $opB = ($tipo === "multipla") ? ($_POST["opcoesB"] ?? null) : null;
    $opC = ($tipo === "multipla") ? ($_POST["opcoesC"] ?? null) : null;
    $opD = ($tipo === "multipla") ? ($_POST["opcoesD"] ?? null) : null;
    $opE = ($tipo === "multipla") ? ($_POST["opcoesE"] ?? null) : null;

    $sql = "INSERT INTO perguntas (tipo, pergunta, opcao_a, opcao_b, opcao_c, opcao_d, opcao_e, resposta)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

  
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$tipo, $pergunta, $opA, $opB, $opC, $opD, $opE, $resposta]);

    echo json_encode(["mensagem" => "Pergunta cadastrada"]);
}

  
?>
