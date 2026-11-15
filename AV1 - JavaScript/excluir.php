<?php


header('Content-Type: application/json; charset=utf-8');

function deletarLinha($nomeArquivo, $numLinha){
  
    if(!file_exists($nomeArquivo)){
      
        return;
    }

  
    $arq = fopen($nomeArquivo, "r");
    $arqTemp= fopen("temp.txt", "w");
    $cont= 1;


  
    while($linha = fgets($arq)){
      
        if($cont != $numLinha){
          
            fwrite($arqTemp, $linha);
        }
      
        $cont++;
    }

  
    fclose($arq);
    fclose($arqTemp);

    unlink($nomeArquivo);
    rename("temp.txt", $nomeArquivo);
}


if(isset($_GET["numero"])){
  
    $numero = $_GET["numero"];

    deletarLinha("perguntas.txt", $numero);
    deletarLinha("opcoes.txt", $numero);
    deletarLinha("respostas.txt", $numero);

  

    echo json_encode(["mensagem" => "Pergunta excluida"]);


  
}
  
?>
