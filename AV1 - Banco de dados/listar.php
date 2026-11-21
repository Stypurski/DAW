<?php


header('Content-Type: application/json; charset=utf-8');
require_once "conexao.php";


$stmt = $pdo->query("SELECT * FROM perguntas ORDER BY id ASC");
$resultados = $stmt->fetchAll();

$lista = [];


foreach($resultados as $row){
  
    $opts = [];

    if($row["tipo"] === "multipla"){

      
        $opts = [
            $row["opcao_a"] ?? "",
            $row["opcao_b"] ?? "",
            $row["opcao_c"] ?? "",
            $row["opcao_d"] ?? "",
            $row["opcao_e"] ?? ""
        ];
      
    }

    $lista[] = [
      
        "numero" => (int)$row["id"],
        "tipo" => $row["tipo"],
        "pergunta" => $row["pergunta"],
        "opcoes" => $opts,
        "resposta" => $row["resposta"]
    ];
  
}

echo json_encode($lista);
?>
