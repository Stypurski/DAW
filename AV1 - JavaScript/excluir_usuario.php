<?php

header('Content-Type: application/json; charset=utf-8');

if(isset($_GET["excluir"])){
  
    $excluirIndex= $_GET["excluir"];

    $arq = fopen("usuarios.txt", "r");
    $temp = fopen("temp_usu.txt", "w");
    $cont = 0;

    while($linha = fgets($arq)){
      
        if ($cont != $excluirIndex){
            fwrite($temp, $linha);
        }
      
        $cont++;
    }

  
    fclose($arq);
    fclose($temp);

    unlink("usuarios.txt");
    rename("temp_usu.txt", "usuarios.txt");

  
    echo json_encode(["mensagem" => "Usuario excluido"]);
  
}


  
?>
