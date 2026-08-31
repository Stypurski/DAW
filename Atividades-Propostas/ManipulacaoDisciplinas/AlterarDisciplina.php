<?php 

$nome = "";
$sigla = "";
$carga = "";
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){

$sigla = $_GET["sigla"];
$msg = "";
echo "Sigla: " . $sigla;
$arqDisciplinas = fopen("disciplinas.txt", "r") or die("Erro ao abrir o arquivo.");

while(!feof($arqDisciplinas)){

    $linha = fgets($arqDisciplinas);
    $colunaDados = explode(";", $linha);

    if($colunaDados[1] == $sigla){
        $nome = $colunaDados[0];
        $carga = $colunaDados[2];
        break;
    }
}

fclose($arqDisciplinas);

$msg = "Disciplina encontrada com sucesso!";

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
        </ul>

        <form action="AlterarDisciplina.php", method="POST">
        Nome : <input type="text" name="nome" value='<?php echo $nome ?>'>
        <br><br>
        Sigla: <input type="text" name="nome" value='<?php echo $sigla?>'>
        <br><br>
        Carga: <input type:"text" name="nome" value='<?php echo $carga ?>'>
        <br><br>
        <input type="submit" value="Alterar disciplina">

    </form>
    <p><?php echo $msg; ?>
    <br>
   </body>
</html>
