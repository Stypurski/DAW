<!DOCTYPE html>
<html lang="pt-br">

 <head>
    <meta charset= "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Gerenciamneto de Alunos</title>
     <link rel="stylesheet" href="alunos.css">
</head>
<body>
    <H1>Listagem alunos</h1>
    <table>
        <tr>
            <th>Matricula</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Acoes</th>
        </tr>
    <?php 

         $arqAlunos= fopen("alunos.txt", "r") or die("Erro ao abrir o arquivo.");

         fgets($arqAlunos);

         while($linha = fgets($arqAlunos)){
            $colunaDados = explode(";", $linha);

            echo "<tr><td>" . $colunaDados[0] . "</td>" . "<td>" . $colunaDados[1] . "</td>" . 
            "<td>" . $colunaDados[2] . "</td>" . "<td>" . 
            "<a href='confirmacao.php?matricula=" . $colunaDados[0] . "&acao=editar'>Editar</a>" . 
            "<a href='confirmacao.php?matricula=" . $colunaDados[0] . "&acao=excluir'>Excluir</a>" . "</td></tr>";
        }

        $msg = "Alunos exibidos com sucesso!";

        fclose($arqAlunos);
    ?>

    </table>
    <p><?php echo $msg; ?></p>
    <br>

</body>
</html>
