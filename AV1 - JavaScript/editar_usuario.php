<?php

header('Content-Type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $indexPost = $_POST["index"];

    $arq = fopen("usuarios.txt", "r");
    $temp= fopen("temp_usu.txt", "w");
    $cont = 0;

    while($linha = fgets($arq)){
        if($cont == $indexPost){
          
            fwrite($temp, $nome . ";" . $email . "\n");
        }else{
          
            fwrite($temp, $linha);
        }
      
        $cont++;
    }

    fclose($arq);
    fclose($temp);

    unlink("usuarios.txt");
    rename("temp_usu.txt", "usuarios.txt");

    echo json_encode(["mensagem"=> "Usuario editado"]);
}

  
?>
