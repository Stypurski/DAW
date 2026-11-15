<?php

header('Content-Type: application/json; charset=utf-8');

$perguntas = file_exists("perguntas.txt") ? file("perguntas.txt") : [];
$opcoes    = file_exists("opcoes.txt") ? file("opcoes.txt") : [];
$respostas = file_exists("respostas.txt") ? file("respostas.txt") : [];

$lista = [];

foreach($perguntas as $index => $linha){
  
    $num   = $index + 1;
    $dados = explode("|", trim($linha));
    $tipo  = count($dados) > 1 ? $dados[0] : "multipla";
    $texto = count($dados) > 1 ? $dados[1] : $dados[0];

    $opts = [];
  
    if($tipo == "multipla" && isset($opcoes[$index])){
      
        $opts = explode(";", trim($opcoes[$index]));
    }

    $resp = isset($respostas[$index]) ? trim($respostas[$index]) : "";

    $lista[] = ["numero"   => $num, "tipo"     => $tipo, "pergunta" => $texto, "opcoes"   => $opts, "resposta" => $resp];
  
}


echo json_encode($lista);



?>
