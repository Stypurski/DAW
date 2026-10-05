<?php

$msg= "";
$usuarios= file_exists("usuarios.txt") ? file("usuarios.txt") : [];
$editarIndex= isset( $_GET["editar"]) ? $_GET["editar"] : null;

$nomeEdit= "";
$emailEdit= "";

if($editarIndex!== null && isset($usuarios[$editarIndex])){
  
    $dados = explode(";", trim($usuarios[$editarIndex]));
    $nomeEdit = isset($dados[0]) ? $dados[0] : "";
    $emailEdit = isset($dados[1]) ? $dados[1] : "";
}

if(isset( $_GET["excluir"])){
  
    $excluirIndex = $_GET["excluir"];
    $arq = fopen("usuarios.txt", "r");
    $temp = fopen("temp_usu.txt", "w");
    $cont = 0;

    while($linha = fgets($arq)){
        if ($cont != $excluirIndex) {
            fwrite($temp, $linha);
        }
        $cont++;
    }
  
    fclose($arq);
    fclose($temp);
  
    unlink( "usuarios.txt");
    rename("temp_usu.txt", "usuarios.txt");

  header("Location: usuarios.php");
  exit;
  
}

if( $_SERVER['REQUEST_METHOD']== 'POST'){
  
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $indexPost = $_POST["index"];

    if($indexPost !== ""){ 
      
        $arq= fopen("usuarios.txt", "r");
        $temp= fopen("temp_usu.txt", "w");
        $cont= 0;
        
      while($linha = fgets($arq)){
            if($cont== $indexPost){
                fwrite($temp, $nome . ";" . $email . "\n");
            }else{
                fwrite($temp, $linha);
            }
            $cont++;
        }
      
      fclose($arq);
      fclose($temp);
      
      unlink("usuarios.txt");  
      rename("temp_usu.txt", "usuarios.txt");
      
    }else{ 
      $arq= fopen("usuarios.txt", "a");
      fwrite($arq, $nome . ";" . $email . "\n");
        
      fclose($arq);
    }

  header("Location: usuarios.php");
  exit;
  
}
  
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container-listagem">
    <h1>Gerenciamento de Usuários</h1>
    <div style="text-align: center; margin-bottom: 20px;">
            <a href="inserir.php">Cadastrar Pergunta</a>
            <a href="listagem.php">Listar Perguntas</a>
    </div>

<div class="container" style="margin: 0 auto 30px auto; width: 100%; max-width: 450px;">
    <form action="usuarios.php" method="POST">
    
      <input type="hidden" name="index" value="<?php echo $editarIndex; ?>">
         
      <label for="nome">Nome do Usuário:</label>          
      <input type="text" name="nome" id="nome" value="<?php echo $nomeEdit; ?>" required>
      
      <label for="email">E-mail do Usuário:</label>          
      <input type="text" name="email" id="email" value="<?php echo $emailEdit; ?>" required>
          
      <input type="submit" value="<?php echo ($editarIndex !== null) ? 'Salvar Alteração' : 'Cadastrar Usuário'; ?>">
 
    </form>
</div>


<table>
<thead>
    <tr>
      <th>Nº</th>
      <th>Nome</th>              
      <th>E-mail</th>              
      <th>Ações</th>            
    </tr>            
</thead>
            
  <tbody>
                
<?php if (empty($usuarios)): ?>
                    
    <tr>                  
      <td colspan="4">Nenhum usuário cadastrado.</td>               
    </tr>
                
  <?php else: ?>
                    
  <?php foreach ($usuarios as $idx => $usu):           
  $dadosUsu = explode(";", trim($usu)); ?>
                    
    <tr>                  
      <td><?php echo $idx + 1; ?></td>                  
      <td><?php echo isset($dadosUsu[0]) ? $dadosUsu[0] : ''; ?></td>                   
      <td><?php echo isset($dadosUsu[1]) ? $dadosUsu[1] : ''; ?></td>
      <td> <a href="usuarios.php?editar=<?php echo $idx; ?>">Editar</a> <a href="usuarios.php?excluir=<?php echo $idx; ?>">Excluir</a> </td> 
    </tr>
                    
  <?php endforeach; ?>  
  <?php endif; ?>
            
  </tbody>        
</table>

</div>

</body>
</html>
