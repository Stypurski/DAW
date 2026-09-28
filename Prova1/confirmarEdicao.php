<?php 

$numero= "";
$pergunta = "";
$opcoesA = "";
$opcoesB = "";
$opcoesC = "";
$opcoesD = "";
$opcoesE = "";
$resposta = "";

if($_SERVER['RESQUEST_METHOD']== 'GET'){

  $numero = $_GET["numero"];


  
   $ArqPerg = fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo de perguntas.");
   $contador = 1;

  while($linha1 = fgets($ArqPerg)){
        if($contador == $numero){
            $pergunta = trim($linha1);
            break;
        }
        $contador++;
  }

    fclose($ArqPerg);



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
        if($contador == $numero){
          $resposta = trim($linha3);
          break;
        }
        $contador++;
    }

    fclose($ArqResp);

}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar edição</title>
  </head>
  <body>
    <h1>Confirmar edição da pergunta</h1>
    <p>Confirme os dados abaixo que serao submetidos a edicao:</p>
    

    <p><strong>Pergunta:</strong> <?php echo $pergunta; ?> </p>

    <p><strong>Opção A:</strong> <?php echo $opcoesA; ?> </p>
    
    <p><strong>Opção B:</strong> <?php echo $opcoesB; ?> </p>

    <p><strong>Opção C:</strong> <?php echo $opcoesC; ?> </p>

    <p><strong>Opção D:</strong> <?php echo $opcoesD; ?> </p>

    <p><strong>Opção E:</strong> <?php echo $opcoesE; ?> </p>

    <p><strong>Resposta:</strong> <?php echo $resposta; ?> </p>


    <p>Deseja editar esta pergunta?</p>

   <form action="editar.php" method="GET">
        <input type="hidden" name="numero" value="<?php echo $numero; ?>">
        <input type="submit" value="Confirmar">
  </form>
  <br>
    
  <form action="inserir.php" method="GET">
    <input type="submit" value="Cancelar">
  </form>

  </body>
</html>
