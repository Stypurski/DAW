<?php

    $msg="";
    
    if(isset($_GET["sucesso"])){
        $msg = "Pergunta cadastrada com sucesso";
    }
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
    $pergunta = $_POST["pergunta"];
    $opcoesA = $_POST["opcoesA"];
    $opcoesB = $_POST["opcoesB"];
    $opcoesC = $_POST["opcoesC"];
    $opcoesD = $_POST["opcoesD"];
    $opcoesE = $_POST["opcoesE"];
    $resposta = $_POST["resposta"];
    

    if(!file_exists("perguntas.txt")){

       $ArqPerg= fopen("perguntas.txt", "w") or die("Erro ao criar arquivo de perguntas.");
       fclose($ArqPerg);
    }
    
    
    if(!file_exists("opcoes.txt")){

       $ArqOp=  fopen("opcoes.txt", "w") or die("Erro ao criar arquivo de opcoes.");
       fclose($ArqOp);
    }
    
    
    if(!file_exists("respostas.txt")){

       $ArqResp= fopen("respostas.txt", "w") or die("Erro ao criar arquivo de respostas.");
       fclose($ArqResp);
    }

    $ArqPerg = fopen("perguntas.txt", "a") or die("Erro ao abrir arquivo de perguntas");
    $linha1 = $pergunta . "\n";
    fwrite($ArqPerg, $linha1);
    fclose($ArqPerg);

    $ArqOp = fopen("opcoes.txt", "a") or die("Erro ao abrir arquivo de opcoes");
    $linha2 =  $opcoesA . ";" . $opcoesB . ";" . $opcoesC . ";" . $opcoesD . ";" . $opcoesE . "\n";
    fwrite($ArqOp, $linha2);
    fclose($ArqOp);
    
    $ArqResp = fopen("respostas.txt", "a") or die("Erro ao abrir arquivo de respostas");
    $linha3 = $resposta."\n";
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
    </head>

    <body>

        <h1>Cadastro de perguntas para questionario</h1>
        <p> Preencha os dados da pergunta</p>

        <form action="inserir.php" method="POST">

        <label for="pergunta">Pergunta: </label>
        <input type="text" name="pergunta" id="pergunta" required>

        
         <label for="opcoesA">Opcao A: </label>
        <input type="text" name="opcoesA" id="opcoesA" required>
        
        <label for="opcoesB">Opcao B: </label>
        <input type="text" name="opcoesB" id="opcoesB" required>
        
        <label for="opcoesC">Opcao C: </label>
        <input type="text" name="opcoesC" id="opcoesC" required>
        
        <label for="opcoesD">Opcao D: </label>
        <input type="text" name="opcoesD" id="opcoesD" required>
        
        <label for="opcoesE">Opcao E: </label>
        <input type="text" name="opcoesE" id="opcoesE" required>
        

        <label for="resposta">Resposta: </label>
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
            
        <ul> 
            <br><br>
            <li><a href="editar.php">Editar pergunta</a></li> 
        </ul>

  <br>
</body>
</html>
