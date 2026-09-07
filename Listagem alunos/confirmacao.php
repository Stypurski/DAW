<?php 
 
$matricula = $_GET["matricula"]; 
$acao = $_GET["acao"]; 
$nome = ""; 
$email = ""; 
 
$arqAlunos = fopen("alunos.txt", "r") or die("Erro ao abrir o arquivo."); 
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
?> 
 
<!DOCTYPE html> 
<html lang="pt-br"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Confirmação</title> 
    <link rel="stylesheet" href="alunos.css"> 
</head> 
<body> 

    <div class="container"> 
        <h1>Confirmação</h1> 
        <p>Dados do aluno:</p> 
        <p>
            <strong>Matrícula:</strong> <?php echo $matricula; ?> 
        </p> 
        <p>
            <strong>Nome:</strong> <?php echo $nome; ?> 
        </p> 
        <p>
            <strong>Email:</strong> <?php echo $email; ?> 
        </p> 

        <?php 

        if($acao == "editar"){ 
            echo "<p>Deseja continuar com a edição deste aluno?</p>"; 
        }else{ 
            echo "<p>Deseja continuar com a exclusão deste aluno?</p>"; 
        } 
        ?> 

        <form action="<?php echo $acao == 'editar' ? 'edicao.php' : 'exclusao.php'; ?>" method="GET"> 
            <input type="hidden" name="matricula" value="<?php echo $matricula; ?>"> 
            <button type="submit">Continuar</button> 
        </form> 
        <br> 
        <a href="listagem.php">Voltar para listagem</a> 
    </div> 
</body> 
</html>