<?php

$numero = "";
$pergunta = "";
$opcoesA = "";
$opcoesB = "";
$opcoesC = "";
$opcoesD = "";
$opcoesE = "";
$resposta = "";
$tipo = "multipla";

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $numero = $_GET["numero"];

    if (file_exists("perguntas.txt")){

        $arqPerg = fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo de perguntas.");
        $cont = 1;

        while ($linha1= fgets($arqPerg)) {
            if ($cont== $numero) {
                $dados= explode("|",trim($linha1));
                if (count($dados) > 1) {
                    $tipo= $dados[0];
                    $pergunta= $dados[1];
                } else {
                    $pergunta = $dados[0];
                }
                break;
            }
            $cont++;
        }
        fclose($arqPerg);
    }




    if (file_exists("opcoes.txt")) {
        
        $ArqOp = fopen("opcoes.txt", "r") or die("Erro ao abrir arquivo de opcoes.");
        $contador = 1;

        while ($linha2= fgets($ArqOp)) {
            if ($contador== $numero) {
                $colunaDados= explode(";", trim($linha2));
                if (count($colunaDados)>= 5) {
                    $opcoesA= $colunaDados[0];
                    $opcoesB= $colunaDados[1];
                    $opcoesC= $colunaDados[2];
                    $opcoesD= $colunaDados[3];
                    $opcoesE= $colunaDados[4];
                }
                break;
            }
            $contador++;
        }
        fclose($ArqOp);
    }



    

if (file_exists("respostas.txt")) {
    
        $ArqResp= fopen("respostas.txt","r") or die("Erro ao abrir arquivo de respostas.");
        $contador= 1;

        while ($linha3= fgets($ArqResp)) {
            if ($contador== $numero) {
                $resposta= trim($linha3);
                break;
            }
            $contador++;
        }
        fclose($ArqResp);
    }
}





if ($_SERVER['REQUEST_METHOD']== 'POST') {
    $pergunta= $_POST["pergunta"];
    $resposta= $_POST["resposta"];
    $numero= $_POST["numero"];
    $tipo= $_POST["tipo"];

    if ($tipo== "multipla") {
        $opcoesA= $_POST["opcoesA"];
        $opcoesB= $_POST["opcoesB"];
        $opcoesC= $_POST["opcoesC"];
        $opcoesD= $_POST["opcoesD"];
        $opcoesE= $_POST["opcoesE"];
        $linhaOpcaoNova = $opcoesA . ";" . $opcoesB . ";" . $opcoesC . ";" . $opcoesD . ";" . $opcoesE . "\n";
    } else {
        $linhaOpcaoNova = "TEXTO\n";
    }


    $arqPerg = fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo de perguntas.");
    $arqPergAlterada = fopen("perguntaAlterada.txt", "w") or die("Erro ao criar arquivo");

    $ArqOp = fopen("opcoes.txt", "r") or die("Erro ao abrir arquivo de opcoes.");
    $ArqOpAlterada = fopen("OpAlterada.txt", "w") or die("Erro ao criar arquivo");

    $ArqResp = fopen("respostas.txt", "r") or die("Erro ao abrir arquivo de respostas.");
    $ArqRespAlterada = fopen("RespAlterada.txt", "w") or die("Erro ao criar arquivo");

    $contador = 1;



    
    while($linha1 = fgets($arqPerg)){
        if($cont == $numero){
            $linha1 = $tipo ."|". $pergunta ."\n";
        }
        fwrite($arqPergAlterada, $linha1);
        $contador++;
}
    $contador = 1;


    while ($linha2 = fgets($ArqOp)) {
        if ($contador == $numero) {
            $linha2 = $linhaOpcaoNova;
        }
        fwrite($ArqOpAlterada, $linha2);
        $contador++;
    } 

    $contador = 1;


    while ($linha3 = fgets($ArqResp)) {
        if ($contador == $numero) {
            $linha3 = $resposta . "\n";
        }
        fwrite($ArqRespAlterada, $linha3);
        $contador++;
    }


    fclose($arqPerg);
    fclose($arqPergAlterada);
    fclose($ArqOp);
    fclose($ArqOpAlterada);
    fclose($ArqResp);
    fclose($ArqRespAlterada);

    unlink("perguntas.txt");
    rename("perguntaAlterada.txt","perguntas.txt");
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
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <div class="container">
    <h1>Alterar pergunta</h1>

    <form action="editar.php" method="POST">

        <input type="hidden" name="numero" value="<?php echo $numero; ?>">
        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">

        <label for="pergunta">Pergunta: </label>
        <input type="text" name="pergunta" id="pergunta" value="<?php echo $pergunta; ?>" required>
 
 
        <?php if ($tipo == "multipla"): ?>
    
        <label for="opcoesA">Opcao A: </label>
        <input type="text" name="opcoesA" id="opcoesA" value="<?php echo $opcoesA; ?>" required>

        <label for="opcoesB">Opcao B: </label>
        <input type="text" name="opcoesB" id="opcoesB" value="<?php echo $opcoesB; ?>" required>

        <label for="opcoesC">Opcao C: </label>
        <input type="text" name="opcoesC" id="opcoesC" value="<?php echo $opcoesC; ?>" required>

        <label for="opcoesD">Opcao D: </label>
        <input type="text" name="opcoesD" id="opcoesD" value="<?php echo $opcoesD; ?>" required>

        <label for="opcoesE">Opcao E: </label>
        <input type="text" name="opcoesE" id="opcoesE" value="<?php echo $opcoesE; ?>" required>
        
        <?php endif; ?>
        
        
        <label for="resposta">Resposta / Gabarito:</label>
        <input type="text" name="resposta" id="resposta" value="<?php echo $resposta; ?>" required>
        
        <input type="submit" value="Salvar alteração">

    </form>
    <?php

    if(!empty($msg)){
        echo "<p class='mensagem'>" . $msg . "</p>";
    }
    ?>

    <br>
        <div style="text-align: center;">
            <a href="listagem.php" style="color: #c2185b; font-weight: bold;">Voltar para listagem</a>
        </div>

    </div>
</body>
</html>
