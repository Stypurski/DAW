<?php

    $msg="";

    $tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : "multipla";

    if(isset($_GET["sucesso"])){
        $msg = "Pergunta cadastrada com sucesso";
    }
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : "multipla";
    $pergunta = $_POST["pergunta"];
    $resposta = $_POST["resposta"];

    if (!file_exists("perguntas.txt")) {
        $ArqPerg = fopen("perguntas.txt", "w") or die("Erro ao criar arquivo de perguntas");
        fclose($ArqPerg);
    }

    if (!file_exists("opcoes.txt")) {
        $ArqOp = fopen("opcoes.txt", "w") or die("Erro ao criar arquivo de opcoes.");
        fclose($ArqOp);
    }

    if (!file_exists("respostas.txt")) {
        $ArqResp = fopen("respostas.txt", "w") or die("Erro ao criar arquivo de respostas.");
        fclose($ArqResp);
    }

        

    $ArqPerg= fopen("perguntas.txt", "a") or die("Erro ao abrir arquivo de perguntas");
        
    $linha1 = $tipo ."|". $pergunta ."\n";
    fwrite($ArqPerg, $linha1);
    fclose( $ArqPerg);

    if ($tipo == "multipla") {   
        $pergunta = $_POST["pergunta"];
        $opcoesA = $_POST["opcoesA"];
        $opcoesB = $_POST["opcoesB"];
        $opcoesC = $_POST["opcoesC"];
        $opcoesD = $_POST["opcoesD"];
        $opcoesE = $_POST["opcoesE"];
        $linha2 = $opcoesA . ";" . $opcoesB . ";" . $opcoesC . ";" . $opcoesD . ";" . $opcoesE . "\n";
    }else{
        $linha2 = "Texto\n";
    }

    $ArqOp = fopen("opcoes.txt", "a") or die("Erro ao abrir arquivo de opcoes");
    fwrite($ArqOp, $linha2);
    fclose($ArqOp);

    $ArqResp = fopen("respostas.txt", "a") or die("Erro ao abrir arquivo de respostas");
    $linha3 = $resposta . "\n";
    fwrite($ArqResp, $linha3);
    fclose($ArqResp);

    header("Location: inserir.php?sucesso=1");
    exit;

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Inserir perguntas</title>
       <link rel="stylesheet" href="estilo.css">
    </head>

    <body>

        <h1>Cadastro de perguntas para questionario</h1>
        <p class="subtitulo">Preencha os dados da pergunta</p>

        <p style="text-align: center; margin-bottom: 20px;">
            <a href="inserir.php?tipo=multipla" style="color: #c2185b; font-weight: bold; margin-right: 10px;">[Múltipla Escolha]</a>
            <a href="inserir.php?tipo=texto" style="color: #c2185b; font-weight: bold;">[Texto]</a>
        </p>

    <form action="inserir.php" method="POST">

        <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">

        <label for="pergunta">Pergunta (<?php echo strtoupper($tipo); ?>): </label>
        <input type="text" name="pergunta" id="pergunta" required>



            
         <?php if ($tipo == "multipla"): ?>
        
         <label for="opcoesA">Opcao A: </label>
         <input type="text" name="opcoesA" id="opcoesA"required>

         <label for="opcoesB">Opcao B: </label>
         <input type="text" name="opcoesB" id="opcoesB"required>

         <label for="opcoesC">Opcao C: </label>
         <input type="text" name="opcoesC" id="opcoesC"required>

         <label for="opcoesD">Opcao D: </label>
         <input type="text" name="opcoesD" id="opcoesD"required>

         <label for="opcoesE">Opcao E: </label>
         <input type="text" name="opcoesE" id="opcoesE"required>
         <?php endif; ?>
        
        <label for="resposta">Resposta / Gabarito: </label>
        <input type="text" name="resposta" id="resposta" required>
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
            
        <br>
        <div style="text-align: center;">
            <a href="listagem.php" style="color: #c2185b; font-weight: bold;">Ver listagem de perguntas</a> | 
            <a href="usuarios.php" style="color: #c2185b; font-weight: bold;">Gerenciar Usuários</a>
        </div>

</body>
</html>
