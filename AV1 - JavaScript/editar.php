<?php

header('Content-Type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
    $pergunta = $_POST["pergunta"];
    $resposta = $_POST["resposta"];
    $numero = $_POST["numero"];
    $tipo= $_POST["tipo"];

  
    if($tipo == "multipla"){
        $linhaOpcaoNova = $_POST["opcoesA"] . ";" . $_POST["opcoesB"] . ";" . $_POST["opcoesC"] . ";" . $_POST["opcoesD"] . ";" . $_POST["opcoesE"] . "\n";
    }else{
        $linhaOpcaoNova = "Texto\n";
    }

    $arqPerg= fopen("perguntas.txt", "r");
    $arqPergAlterada = fopen("perguntaAlterada.txt", "w");

    $ArqOp= fopen("opcoes.txt", "r");
    $ArqOpAlterada = fopen("OpAlterada.txt", "w");

    $ArqResp= fopen("respostas.txt", "r");
    $ArqRespAlterada = fopen("RespAlterada.txt", "w");

  
    $contador = 1;
  
    while($linha1 = fgets($arqPerg)){
      
        if($contador == $numero){
    
            $linha1 = $tipo . "|" . $pergunta . "\n";
        }
      
        fwrite($arqPergAlterada, $linha1);
        $contador++;
    }

    $contador = 1;
  
    while($linha2 = fgets($ArqOp)){
      
        if($contador == $numero){
          
            $linha2 = $linhaOpcaoNova;
        }
      
        fwrite($ArqOpAlterada, $linha2);
        $contador++;
    }

  
    $contador = 1;
  
    while($linha3 = fgets($ArqResp)){
      
        if($contador == $numero){
          
            $linha3 = $resposta . "\n";
        }
      
        fwrite($ArqRespAlterada, $linha3);
        $contador++;
    }


  
    fclose($arqPerg);
    fclose($arqPergAlterada);
    fclose($ArqOp);
    fclose($ArqOpAlterada);
    fclose($ArqResp);
    fclose($ArqRespAlterada);

  
    unlink("perguntas.txt");
    rename("perguntaAlterada.txt", "perguntas.txt");
    unlink("opcoes.txt");
    rename("OpAlterada.txt", "opcoes.txt");
    unlink("respostas.txt");
    rename("RespAlterada.txt", "respostas.txt");


  
    echo json_encode(["mensagem" => "Pergunta alterada"]);
}

  
?>
