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

    $numero = $_GET["numero"];
    $ArqPerg= fopen("perguntas.txt", "r") or die("Erro ao criar arquivo de perguntas.");

    $cont = 1;

    while($linha1 = fgets($arqPerg)){

        if($cont == $numero){
            $pergunta = trim($linha1);
            break;
    }
        $cont++;
}

    fclose($arqPerg);

    $ArqOp = fopen("opcoes.txt", "r") or die("Erro ao abrir arquivo de opcoes.");

    $contador = 1;

    while($linha2 = fgets($ArqOp)){
        if($contador == $numero){

            $colunaDados = explode(";", trim($linha2));

            $opcoesA = $colunaDados[0];
            $opcoesB = $colunaDados[1];
            $opcoesC = $colunaDados[2];
            $opcoesD = $colunaDados[3];
            $opcoesE = $colunaDados[4];

            break;
        }
        $contador++;
    }

    fclose($ArqOp);

    $ArqResp = fopen("respostas.txt", "r") or die("Erro ao abrir arquivo de respostas.");
    $contador = 1;

     while($linha3 = fgets($ArqResp)){
         
        if($contador== $numero){
            $resposta = trim($linha3);
            break;
        }
        $contador++;
    }

    fclose($ArqResp);
} 

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $pergunta = $_POST["pergunta"];
    $opcoesA = $_POST["opcoesA"];
    $opcoesB = $_POST["opcoesB"];
    $opcoesC = $_POST["opcoesC"];
    $opcoesD = $_POST["opcoesD"];
    $opcoesE = $_POST["opcoesE"];
    $resposta = $_POST["resposta"];
    $numero = $_POST["numero"];
    
    

    $ArqPerg= fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo de perguntas.");
    $arqPergAlterada = fopen("perguntaAlterada.txt", "w") or die("Erro ao criar arquivo");
    
    $ArqOp= fopen("opcoes.txt", "r") or die("Erro ao abrir arquivo de opcoes.");
    $ArqOpAlterada = fopen("OpAlterada.txt", "w") or die("Erro ao criar arquivo");
    
    $ArqResp= fopen("respostas.txt", "r") or die("Erro ao abrir arquivo de respostas.");
    $ArqRespAlterada = fopen("RespAlterada.txt", "w") or die("Erro ao criar arquivo");
    

     $contador = 1;
    
    while($linha1 = fgets($arqPerg)){

        if($contador == $numero){
            $linha1 = $pergunta . "\n";
        }

        fwrite($arqPergAlterada, $linha1);
        $contador++;
    } 

     $contador = 1;
    
     while($linha2 = fgets($ArqOp)){

       if($contador == $numero){
            $linha2 = $opcoesA . ";" . $opcoesB . ";" . $opcoesC . ";" . $opcoesD . ";" . $opcoesE . "\n";
        }

        fwrite($ArqOpAlterada, $linha2);
        $contador++;
    } 

    $contador = 1;
    
    while($linha3 = fgets($ArqResp)){
        
        if($contador == $numero){
            $linha3 = $resposta . "\n";
        }

        fwrite($ArqRespAlterada, $linha3);
        $contador++;
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
    <h1>Alterar pergunta</h1>

    <form action="editar.php" method="POST">

        <input type="hidden" name="numero" value="<?php echo $numero; ?>">

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
        <input type="text" name="opcoesE" id="opcoesE" value="<?php echo $opcoesE; ?>" required>
        
        
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
