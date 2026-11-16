<?php
$servidor = "localhost";
$username = "root";
$senha = "";
$database= "faeterj3dawmanha";

$conn = new mysqli($servidor,$username,$senha,$database);

if($coon -> connect_error){
    
    die("ERRO, coneccao falhou");
}

$resultado = ""; 

if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    $matricula = $_GET["matricula"];
    $nome = $_GET["nome"];
    $email = $_GET["email"];
    $comandoSQL = "UPDATE `alunos` SET `nome` = '$nome', SET 'email' = '$email' WHERE 'matricula' = '$matricula'";
    
    $resultado = $conn->query($comandoSQL);

}

$retorno = json_encode($resultado);
echo $retorno;

?>
