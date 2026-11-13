<?php
header('Content-Type: application/json; charset=utf-8');

$x = (float) $_GET['x'];
$y = (float) $_GET['y'];
$sinal = $_GET['sinal'];

$resultado = "";

if($sinal == '+'){
    $resultado = $x + $y;
}else{
    if($sinal == '-'){
        $resultado = $x - $y;
    }else{
        if($sinal == '*'){
            $resultado = $x * $y;
        }else{
            if($sinal == '/'){
                if($y == 0){
                    $resultado = "divisao por 0 invalida";
                }else{
                    $resultado =  $x / $y;
                }
            }else{
                $resultado = "operador invalido";
            }
        }
    }
}


echo json_encode(["resultado" => $resultado]);

?>
