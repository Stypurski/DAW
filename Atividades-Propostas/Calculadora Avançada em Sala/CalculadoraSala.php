package AtividadesPropostas.CalculadoraAvancada.CalculadoraSala;

import org.springframework.web.bind.annotation.*;
import java.util.HashMap;
import java.util.Map;

@RestController
@RequestMapping("/api")
@CrossOrigin(origins = "*")
  
public class Controlador{
  
  @GetMapping("/calcular")
  
  public Map<String, Object> calcular(@RequestParam double x, @RequestParam double y, @RequestParam String sinal) { Map<String, Object> resposta = new HashMap<>();

    if (sinal.equals("+")) {
      resposta.put("resultado", x + y);
    }else{
      if(sinal.equals("-")){
        resposta.put("resultado", x - y);
    }else{
      if(sinal.equals("*")){
        resposta.put("resultado", x * y);
    }else{
      if(sinal.equals("/")){
        if(y == 0){
          resposta.put("resultado", "Erro: Divisão por zero!");
        }else{
          resposta.put("resultado", x / y);
        }
      }
    }}}
      return resposta;
}
}

2. HTML + JavaScript (index.html)
Mantém a estrutura do seu professor, usando apenas o JSON.parse para ler a resposta:

HTML
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calculadora JSON</title>
    <script>
        function Calcula() {
            let a = document.getElementById("a").value;
            let b = document.getElementById("b").value;
            let op = document.getElementById("op").value;

            let xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Transforma o texto recebido do Java em objeto JSON
                    let dados = JSON.parse(this.responseText);

                    // Exibe o valor do campo "resultado"
                    document.getElementById("msg").innerHTML = "Resultado: " + dados.resultado;
                }
            };

            // Trata o sinal de '+' para não quebrar na URL
            let sinal = encodeURIComponent(op);

            xmlhttp.open("GET", "http://localhost:8080/api/calcular?x=" + a + "&y=" + b + "&sinal=" + sinal);
            xmlhttp.send();
        }
    </script>
</head>
<body>
    <form name="frmCalc">
        a: <input type="text" id="a"> <br> 
        operador (+, -, *, /): <input type="text" id="op"><br>
        b: <input type="text" id="b"><br><br>
        <input type="button" value="Enviar" onclick="Calcula()">
    </form>
    
    <br>
    <h3 id="msg"></h3>
</body>
</html>

