<?php

$matricula = "";
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $matricula = $_GET["matricula"];
    $msg = "";

$arqAlunos = fopen("alunos.txt", "r") or die("Erro ao abrir o arquivo!");
$arqAlunosAlterado = fopen("alunosAlterados.txt", "w") or die ("Erro ao criar  arquivo!");

$linha = fgets($arqAlunos);
fwrite($arqAlunosAlterado, $linha);


while($linha = fgets($arqAlunos)){

    $colunaDados = explode(";", $linha);

    if(trim($colunaDados[0]) == $matricula){ 
        continue; 
    } 

    fwrite($arqAlunosAlterado, $linha);
}

fclose($arqAlunos);
fclose($arqAlunosAlterado);

unlink("alunos.txt");
rename("alunosAlterados.txt", "alunos.txt");

$msg = "Excluido com sucesso!";

}
?>

<!DOCTYPE html>
<html>
  <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Gerenciamneto de Alunos</title>
      <link rel="stylesheet" href="alunos.css">
   </head>
   <body>
       <h1>Excluir Aluno</h1>
       <br>
       <ul>
           <li><a href="listagem.php">Listar todas os Alunos</a></li>
           <li><a href="edicao.php">Editar Aluno</a></li>
        </ul>

    <p><?php echo $msg; ?>
    <br>
   </body>
</html>