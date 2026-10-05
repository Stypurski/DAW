<?php

$perguntas= file_exists("perguntas.txt")? file("perguntas.txt") : [];
$opcoes= file_exists("opcoes.txt")? file("opcoes.txt") : [];
$respostas= file_exists("respostas.txt")? file("respostas.txt") : [];
$verNumero= isset($_GET["ver"])? $_GET["ver"] : null;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Perguntas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container-listagem">
    <h1>Listagem de Perguntas</h1>
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="inserir.php">Cadastrar Pergunta</a>
        <a href="usuarios.php">Gerenciar Usuários</a>
    </div>

<?php  
  if ($verNumero && isset($perguntas[$verNumero - 1])): 
?>
    <div class="mensagem" style="text-align: left; background-color: #fff; border: 2px solid #d81b60; margin-bottom: 25px;">
    <h3 style="color: #c2185b; margin-bottom: 10px;">Detalhes da Pergunta #<?php echo $verNumero; ?></h3>
               
      
<?php 
  $pDados = explode("|", trim($perguntas[$verNumero - 1]));
  $tipoDet = count($pDados) > 1 ? $pDados[0] : "multipla";
  $pTextoDet = count($pDados) > 1 ? $pDados[1] : $pDados[0];
  $respTextoDet = trim($respostas[$verNumero - 1] ?? "");
?>

    <p><strong>Pergunta:</strong>  <?php echo $pTextoDet; ?>  </p>
    <p><strong>Tipo:</strong> <?php echo strtoupper($tipoDet); ?></p>

<?php 
    if ($tipoDet == 'multipla' && isset($opcoes[$verNumero - 1])): 
    $opts = explode(";", trim($opcoes[$verNumero - 1]));
?>

    <p style="margin-top: 10px;"> 
    <strong>Opções de Resposta:</strong></p>
    <ul style="margin-left: 20px; color: #8e3157;">
      
      <li>A) <?php echo isset($opts[0]) ? $opts[0] : ''; ?></li>
      
      <li>B) <?php echo isset($opts[1]) ? $opts[1] : ''; ?></li>
      
      <li>C) <?php echo isset($opts[2]) ? $opts[2] : ''; ?></li>
                        
      <li>D) <?php echo isset($opts[3]) ? $opts[3] : ''; ?></li>
                        
      <li>E) <?php echo isset($opts[4]) ? $opts[4] : ''; ?></li>
                    
    </ul>
               
  <?php endif; ?>

    <p style="margin-top: 10px;">
    <strong>Resposta / Gabarito:</strong> 
    <?php echo $respTextoDet; ?></p>
                
    <br>
       <a href="listagem.php">Fechar Detalhes</a>
            
    </div>
      
   <?php endif; ?>



    <table>
      <thead>
      <tr>
        <th>Nº</th>
        <th>Pergunta</th>
        <th>Tipo</th>            
        <th>Ações</th>          
      </tr>      
      </thead>

    <tbody>
      
      <?php if (empty($perguntas)): ?>
    
      <tr>
      <td colspan="4">Nenhuma pergunta cadastrada.</td>
      </tr>
                  
    <?php else: ?>
                    
    <?php 
      foreach ($perguntas as $index => $linha): 
      $num = $index + 1;
      $dados = explode("|", trim($linha));
      $tipoTabela = count($dados) > 1 ? $dados[0] : "multipla";
      $textoTabela = count($dados) > 1 ? $dados[1] : $dados[0];
    ?>
                    
        <tr>              
          <td><?php echo $num; ?></td>  
          <td><?php echo $textoTabela; ?></td>                
        <td><?php echo strtoupper($tipoTabela); ?></td>
                      
        <td>                  
          <a href="listagem.php?ver=<?php echo $num; ?>">Visualizar</a>  
          <a href="confirmar_edicao.php?numero=<?php echo $num; ?>">Editar</a>                 
          <a href="excluir.php?numero=<?php echo $num; ?>">Excluir</a>                
        </td>            
        </tr>
                    
        <?php endforeach; ?>
        
    <?php endif; ?>
            
    </tbody>
        
    </table>
    </div>

</body>
</html>
