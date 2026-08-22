<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calculadora</title> 
</head>
<body>
    <form action="Calculadora.php" method ="GET" name = "Calculadora">
        x: <input type="number" name="x"><br>
		sinal: <input type="text" name="sinal"><br>
		y: <input type="number" name="y"><br>
		<input type="submit" value="enviar">
    </form>
</body>
</html>


<?php

$valor1 = $_GET["x"];
$valor2 = $_GET["y"];
$sinal = $_GET["sinal"];

switch($sinal){
    case "+":
		$final = $valor1 + $valor2;
		break;
	
	case "-":
		$final = $valor1 - $valor2;
		break;
		
	case "*":
		$final = $valor1 * $valor2;
		break;
		
	case "/":
		$final = $valor1 / $valor2;
		break;
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Calculadora</title> 
	</head> 
	<body>
		<?php echo "<h1>Resultado: $final </h1>"; ?>
	</body>
	</html>

