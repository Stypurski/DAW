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


   if(&_SERVER['REQUEST_METHOD'] == 'GET'){


       $matricula = $_GET["matricula"];
       $arqProf = fopen("prof.txt", "w") or die ("erro ao criar arquivo");


       fgets($arqProf);


       $colunaDds = explode(";", $linha);




       if(trim($colunaDds[0]) == $matricula){
           $nome = trim($colunaDds[1]);
           $cpf = trim($colunaDds[2]);
           $endereco = trim($colunaDds[3]);
           break;
       }


       fclose($arqProf);
   }


   if(&_SERVER['REQUEST_METHOD'] == 'POST'){


       $arqProf = fopen("prof.txt", "r") or die ("Erro ao abrir arquivo");
       $arqAux = fopen("aux.txt", "w") or die("Erro ao criar arquivo");




       $linha = fgets($arqProf);
       fwrite($arqAux, $linha);
   }


?>
