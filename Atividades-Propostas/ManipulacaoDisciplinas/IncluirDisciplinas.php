<?php

$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nome = $_POST["nome"];
    $sigla = $_POST["sigla"];
    $carga = $_POST["carga"];

    echo "Nome: " . $nome . "Sigla: " . $sigla . "Carga: " . $carga;

    if(!file_exists("disciplinas.txt")){

      $arqDisciplinas = fopen("disciplinas.txt", "w") or die("Erro ao criar arquivo.");
      $linha = "Nome;Sigla;Carga\n";
      fwrite($arqDisciplinas, $linha);
      fclose($arqDisciplinas);

    }

    $arqDisciplinas = fopen("disciplinas.txt", "a") or die("Erro ao abrir o arquivo.");
    $linha = $nome . ";" . $sigla . ";" . $carga . "\n";
    fwrite($arqDisciplinas, $linha);
    fclose($arqDisciplinas);
    $msg = "Disciplina incluida com sucesso!";

}
?>



<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Disciplinas</title>
    </head>
    <body>
        <h1>Cadastro de nova disciplina</h1>
        <form action="IncluirDisciplinas.php" method="POST">
        <input type="text" name="nome">
        <br><br>
        <input type="text" name="sigla">
        <br><br>
        <input type="text" name="carga">
        <br><br>
        <input type="submit" value="Incluir disciplina">
    </form>
    <p><?php echo $msg; ?></p>
    <br>
    </body>
</html>