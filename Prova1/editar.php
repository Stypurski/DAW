<?php

$numero = "";
$pergunta = "";
$opcoesA = "";
$opcoesB = "";
$opcoesC = "";
$opcoesD = "";
$opcoesE = "";
$resposta = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $numero = $_GET["numero];
    $ArqPerg= fopen("perguntas.txt", "r") or die("Erro ao criar arquivo de perguntas.");


    fgets($arqPerg);

    while($linha1 = fgets($arqPerg)){

        $colunaDados = explode(";", $linha1);
    }

    fclose($arqPerg);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $pergunta = $_POST["pergunta"];
    $opcoesA = $_POST["opcoesA"];
    $opcoesB = $_POST["opcoesB"];
    $opcoesC = $_POST["opcoesC"];
    $opcoesD = $_POST["opcoesD"];
    $opcoesE = $_POST["opcoesE"];
    $resposta = &_POST["resposta"];
    
    

    $ArqPerg= fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo de perguntas.");
    $arqPergAlterada = fopen("perguntaAlterada.txt", "w") or die("Erro ao criar arquivo");
    
    $ArqOp= fopen("opcoes.txt", "r") or die("Erro ao abrir arquivo de opcoes.");
    $ArqOpAlterada = fopen("OpAlterada.txt", "w") or die("Erro ao criar arquivo");
    
    $ArqResp= fopen("respostas.txt", "r") or die("Erro ao abrir arquivo de respostas.");
    $ArqRespAlterada = fopen("RespAlterada.txt", "w") or die("Erro ao criar arquivo");
    
    

    $linha1 = fgets($ArqPerg);
    fwrite($arqPergAlterada, $linha1);
    
    $linha2 = fgets($ArqOp);
    fwrite($ArqOpAlterada, $linha2);
    
    $linha3 = fgets($AperguntasrqResp);
    fwrite($ArqRespAlterada, $linha3);
    
    
    
    while($linha1 = fgets($arqPerg)){

        $colunaDados1 = explode(";", $linha1);

        fwrite($arqPergAlterada, $linha);
    }
    
     while($linha2 = fgets($ArqOp)){

        $colunaDados2 = explode(";", $linha2;

        fwrite($ArqOpAlterada, $linha2);
    }
    
    while($linha3 = fgets($ArqResp)){
perguntas
        $colunaDados3 = explode(";", $linha3;

        fwrite($ArqRespAlterada, $linha3);
    }
    
    


    fclose($ArqPerg);
    fclose($arqPergAlterada);
    fclose($ArqOp);
    fclose($ArqOpAlterada);
    fclose($ArqResp);
    fclose($ArqRespAlterada);
    

    unlink("perguntas.txt");
    rename("perguntaAlterada.txt", "perguntas.txt");
    unlink("opcoes.txt");
    rename("OpAlterada.txt", "opcoes.txt");
    unlink("respostas.txt");
    rename("RespAlterada.txt", "respostas.txt");

    $msg = "Alterada com sucesso";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edicao de pergunta</title>
</head>

<body>
    <h1>Alterar pergunta/h1>

    <form action="editar.php" method="POST">

        <label for="pergunta">Pergunta: </label>
        <input type="text" name="pergunta" id="pergunta" value="<?php echo $pergunta; ?>" required>
 
 
 
        <label for="opcoesA">Opcao A: </label>
        <input type="text" name="opcoesA" id="opcoesA" value="<?php echo $opcoesA; ?>" required>

        <label for="opcoesB">Opcao B: </label>
        <input type="text" name="opcoesB" id="opcoesB" value="<?php echo $opcoesB; ?>" required>
        
        <label for="opcoesC">Opcao C: </label>
        <input type="text" name="opcoesC" id="opcoesC"  value="<?php echo $opcoesC; ?>" required>
        
        <label for="opcoesD">Opcao D: </label>
        <input type="text" name="opcoesD" id="opcoesD" value="<?php echo $opcoesD; ?>" required>
        
        <label for="opcoesE">Opcao E: </label>
        <input type="text" name="opcoesE" id="opcoesE" value="<?php echo $opcoesD; ?>" required>
        
        
        <label for="resposta">Resposta:</label>
        <input type="text" name="resposta" id="resposta" value="<?php echo $resposta; ?>" required>

        <input type="submit" value="Salvar alteração">

    </form>
    <?php

    if(!empty($msg)){
        echo "<p class='mensagem'>" . $msg . "</p>";
    }
    ?>

    <br>
    <a href="listagem.php">Voltar para  cadastro</a>

</body>
</html>
