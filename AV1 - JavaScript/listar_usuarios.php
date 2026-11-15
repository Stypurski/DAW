<?php
header('Content-Type: application/json; charset=utf-8');

$usuarios =file_exists("usuarios.txt") ? file("usuarios.txt") : [];
$lista = [];

foreach ($usuarios as $idx => $usu){
    $dados= explode(";", trim($usu));
    $lista[] =[
        "index" => $idx,
        "nome"  => isset($dados[0]) ? $dados[0] : "",
        "email" => isset($dados[1]) ? $dados[1] : ""
    ];
}

echo json_encode($lista);
?>
