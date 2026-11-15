<?php

header('Content-Type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome  = $_POST["nome"];
    $email = $_POST["email"];

    $arq = fopen("usuarios.txt", "a");
    fwrite($arq, $nome . ";" . $email . "\n");
    fclose($arq);

    echo json_encode(["mensagem" => "Usuário cadastrado com sucesso!"]);
}
  
?>
