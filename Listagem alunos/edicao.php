<?php

$matricula = "";
$nome = "";
$email = "";
$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $matricula = $_GET["matricula"];
    $arqAlunos = fopen("alunos.txt", "r") or die("Erro ao abrir o arquivo!");

    fgets($arqAlunos);

    while($linha = fgets($arqAlunos)){

        $colunaDados = explode(";", $linha);

        if(trim($colunaDados[0]) == $matricula){
            $nome = trim($colunaDados[1]);
            $email = trim($colunaDados[2]);
            break;
        }
    }

    fclose($arqAlunos);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $arqAlunos = fopen("alunos.txt", "r") or die("Erro ao abrir o arquivo!");

    $arqAlunosAlterado = fopen("alunosAlterados.txt", "w") or die("Erro ao criar arquivo!");

    $linha = fgets($arqAlunos);
    fwrite($arqAlunosAlterado, $linha);

    while($linha = fgets($arqAlunos)){

        $colunaDados = explode(";", $linha);

        if(trim($colunaDados[0]) == $matricula){
            $linha = $matricula . ";" . $nome . ";" . $email . "\n";
        }

        fwrite($arqAlunosAlterado, $linha);
    }

    fclose($arqAlunos);
    fclose($arqAlunosAlterado);

    unlink("alunos.txt");
    rename("alunosAlterados.txt", "alunos.txt");

    $msg = "Alterado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Alunos</title>
    <link rel="stylesheet" href="alunos.css">
</head>

<body>
<div class="container">
    <h1>Alterar aluno</h1>
    <p>Altere os dados do aluno:</p>

    <form action="edicao.php" method="POST">

        <label for="matricula">Matrícula:</label>
        <input type="text" name="matricula" id="matricula"  value="<?php echo $matricula; ?>" readonly>
 
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>

        <input type="submit" value="Salvar alteração">

    </form>
    <?php

    if(!empty($msg)){
        echo "<p class='mensagem'>" . $msg . "</p>";
    }
    ?>

    <br>
    <a href="listagem.php">Voltar para listagem</a>
</div>
</body>
</html>