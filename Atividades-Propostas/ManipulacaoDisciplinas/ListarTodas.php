<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Listar todas as Disciplinas</h1>
        <table>
            <tr>
                <th>Nome</th>
                <th>Sigla</th>
                <th>Carga</th>
            </tr>

    <?php

        $arqDisciplinas = fopen("disciplinas.txt", "r") or die("Erro ao abrir o arquivo.");

        while(!feof($arqDisciplinas)){
            $linha = fgets($arqDisciplinas);
            $colunaDados = explode(";", $linha);

            echo "<tr><td>" . $colunaDados[0] . "</td>" . "<td>" . $colunaDados[1] . "</td>" . "<td>" . $colunaDados[2] . "</td></tr>";
        }

        fclose($arqDisciplinas);

        $msg = "Disciplinas cadastradas listadas com sucesso!";

        ?>

        </table>
        <p><?php echo $msg; ?></p>
        <br>
    </body>
</html>