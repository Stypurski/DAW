<?php

    $msg = "";

    if (isset($_GET["sucesso"])) {
    
         $msg="Aluno cadastrado com sucesso!";
    }


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    if(!file_exists("alunos.txt")){

       $ArqAluno = fopen("alunos.txt", "w") or die("Erro ao criar arquivo.");

       $linha = "Matricula;Nome;Email\n";

       fwrite($ArqAluno, $linha);

       fclose($ArqAluno);

    }

    $ArqAluno = fopen("alunos.txt", "a") or die("Erro ao abrir arquivo");
    $linha = $matricula.";".$nome.";".$email."\n";
    fwrite($ArqAluno, $linha);
    fclose($ArqAluno);

       header("Location: listagem.php?sucesso=1");
       exit;

}
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Gerenciamneto de Alunos</title>
       <link rel="stylesheet" href="alunos.css">
    </head>

<body>
    <div class="container">

        <h1>Cadastro Aluno</h1>
        <p class = "subtitulo">Preencha com os dados do aluno</p>

        <form action="cadastro.php" method="POST">

        <label for="matricula">Matricula: </label>
        <input type="text" name="matricula" id="matricula" required>

        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" required>

        <label for="email">Email: </label>
        <input type="email" name="email" id="email" required>

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

                    <ul> 

            <br><br>
            <li><a href="listagem.php">Listar todos os Alunos</a></li> 
        </ul>

    </div>
</div>

  <br>
</body>
</html>


