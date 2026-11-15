<?php

header('Content-Type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : "multipla";
    $pergunta= $_POST["pergunta"];
    $resposta = $_POST["resposta"];

    if(!file_exists("perguntas.txt")){
      
        $ArqPerg = fopen("perguntas.txt", "w");
        fclose($ArqPerg);
    }


  
    if(!file_exists("opcoes.txt")){
      
        $ArqOp= fopen("opcoes.txt", "w");
        fclose($ArqOp);
    }


  
    if(!file_exists("respostas.txt")){
      
        $ArqResp= fopen("respostas.txt", "w");
        fclose($ArqResp);
    }

  
    $ArqPerg= fopen("perguntas.txt", "a");
  
    fwrite($ArqPerg, $tipo . "|" . $pergunta . "\n");
    fclose($ArqPerg);

  
    if($tipo== "multipla"){
      
        $linha2 = $_POST["opcoesA"] . ";" . $_POST["opcoesB"] . ";" . $_POST["opcoesC"] . ";" . $_POST["opcoesD"] . ";" . $_POST["opcoesE"] . "\n";
    }else{
        $linha2 = "Texto\n";
    }

  
    $ArqOp= fopen("opcoes.txt", "a");
    fwrite($ArqOp, $linha2);
    fclose($ArqOp);

    $ArqResp = fopen("respostas.txt", "a");
    fwrite($ArqResp, $resposta . "\n");
    fclose($ArqResp);

  
    echo json_encode(["mensagem" => "Pergunta cadastrada com sucesso!"]);
  
}


  
?>
