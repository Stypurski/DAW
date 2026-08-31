<?php

$nome = "";
$sigla = "";
$carga = "";
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nome = $_POST["nome"];
    $sigla = $_POST["sigla"];
    $carga = $_POST["carga"];
    $msg = "";

$arqDisciplinas = fopen("disciplinas.txt", "r") or die("Erro ao abrir o arquivo!");
$arqDisciplinasAlterado = fopen("disciplinasAlterado.txt", "w") or die ("Erro ao criar  arquivo!");

$linha = fgets($arqDisciplinas);
fwrite($arqDisciplinasAlterado, $linha);


while(!feof($arqDisciplinas)){

    $linha = fgets($arqDisciplinas);
    $colunaDados = explode(";", $linha);

    if($colunaDados[1] == $sigla ){
       continue;
    }

   fwrite($arqDisciplinasAlterado, $linha);

}

fclose($arqDisciplinas);
fclose($arqDisciplinasAlterado);
$msg = "Excluido com sucesso!";

}
?>

<!DOCTYPE html>
<html>
  <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
       <h1>Alterar Disciplina</h1>
       <br>
       <ul>
           <li><a href="ListarTodas.php">Listar todas as Disciplinas</a></li>
           <li><a href="IncluirDisciplina.php">Incluir Disciplina</a></li>
           <li><a href="AlterarDisciplina.php">Alterar Disciplina</a></li>
        </ul>

    <p><?php echo $msg; ?>
    <br>
   </body>
</html>