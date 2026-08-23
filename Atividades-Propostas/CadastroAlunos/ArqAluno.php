<?php

    $msg = "";

    if (isset($_GET["sucesso"])) {
    
         $msg="Aluno cadastrado com sucesso!";
    }


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nome = $_POST["nome"];
    $curso = $_POST["curso"];
    $matricula = $_POST["matricula"];

    if(!file_exists("alunos.txt")){

       $ArqAluno = fopen("alunos.txt", "w") or die("Erro ao criar arquivo.");

       $linha = "Nome;Curso;Matricula\n";

       fwrite($ArqAluno, $linha);

       fclose($ArqAluno);

    }

    $ArqAluno = fopen("alunos.txt", "a") or die("Erro ao abrir arquivo");
    $linha = $nome . ";" . $curso . ";" . $matricula . "\n";
    fwrite($ArqAluno, $linha);
    fclose($ArqAluno);

       header("Location: ArqAluno.php?sucesso=1");
       exit;

}
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Cadastro de Alunos</title>
       <link rel="stylesheet" href="ArqAluno.css">
    </head>

<body>
    <div class="container">

        <h1>Cadastro Aluno</h1>
        <p class = "subtitulo">Preencha com os dados do aluno</p>

        <form action="ArqAluno.php" method="POST">

        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" required>

        <label for="curso">Curso: </label>
        <input type="text" name="curso" id="curso" required>

        <label for="matricula">Matricula: </label>
        <input type="text" name="matricula" id="matricula" required>

        <input type="submit" value="Cadastrar">
    
        </form>
        <?php
            
            if(!empty($msg)){
                ?>
                <p class="Mensagem">
                    <?php echo $msg; ?>
                </p>
                <?php
            } 
            ?>
</div>
</body>
</html>


