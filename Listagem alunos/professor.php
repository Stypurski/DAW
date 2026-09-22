// pedir professor
// inserir professor no arquivo
// perguntar se deseja alterar professor
// caso sim exibir dados que vao ser alterados
//perguntar se deseja continuar
// pedir novos dados
// criar um novo arquivo com novo professor
// substituir o lacal na memoria do arquivo antigo pelo arquivo novo


<?php
   $matricula = "";
   $nome = "";
   $cpf = "";
   $endereco = "";


   if($_SERVER['REQUEST_METHOD'] == 'GET'){


       $matricula = $_GET["matricula"];
       $arqProf = fopen("prof.txt", "r") or die ("erro ao criar arquivo");


     while($linha = fgets($arqProf)){

		$colunaDds = explode(";", $linha);

		if(trim($colunaDds[0]) == $matricula){
			$nome = trim($colunaDds[1]);
			$cpf = trim($colunaDds[2]);
			$endereco = trim($colunaDds[3]);
			break;
    }
}


       fclose($arqProf);
   }


   if($_SERVER['REQUEST_METHOD'] == 'POST'){


		$matricula = $_POST["matricula"];
		$nome = $_POST["nome"];
		$cpf = $_POST["cpf"];
		$endereco = $_POST["endereco"];

       $arqProf = fopen("prof.txt", "r") or die ("Erro ao abrir arquivo");
       $arqAux = fopen("aux.txt", "w") or die("Erro ao criar arquivo");

	$linha = fgets($arqProf);
    fwrite($arqAux, $linha);

    while($linha = fgets($arqProf)){

        $colunaDds = explode(";", $linha);

        if(trim($colunaDds[0]) == $matricula){
            $linha = $matricula . ";" . $nome . ";" . $cpf . ";" . $endereco . "\n";
        }

        fwrite($arqAux, $linha);
    }

    fclose($arqProf);
    fclose($arqAux);

    unlink("prof.txt");
    rename("aux.txt", "prof.txt");

    $msg = "Alterado com sucesso!";
}

   }


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento Professor</title>
    <link rel="stylesheet" href="alunos.css">
</head>

<body>
<div class="container">
    <h1>Alterar professor</h1>
    <p>Altere os dados do professor:</p>

    <form action="professor.php" method="POST">

        <label for="matricula">Matrícula:</label>
        <input type="text" name="matricula" id="matricula"  value="<?php echo $matricula; ?>" readonly>
 
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" required>

        <label for="cpf">Cpf:</label>
        <input type="cpf" name="cpf" id="cpf" value="<?php echo $cpf; ?>" required>

		<label for="endereco">Endereco:</label>
        <input type="endereco" name="endereco" id="endereco" value="<?php echo $endereco; ?>" required>

        <input type="submit" value="Salvar alteração">

    </form>
    <?php

    if(!empty($msg)){
        echo "<p class='mensagem'>" . $msg . "</p>";
    }
    ?>

    <br>
    <a href="listagem.php">Voltar para listagem</a>
</div>
</body>
</html>
