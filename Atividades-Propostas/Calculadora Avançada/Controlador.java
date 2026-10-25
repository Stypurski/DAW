package Atividades-Propostas.CalculadoraAvancada.Controlador;

import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api")
@CrossOrigin(origins = "*")

public class Controlador{
    
    @GetMapping("/calcular")
    public String Calcular(@RequestParam double x, @RequestParam double y, @RequestParam String sinal) {

        double resultadoFinal = 0;
        
        switch (sinal){
            case "+":
                resultadoFinal = x + y;
                break;
            case "-":
                resultadoFinal = x - y;
                break;
            case "*":
                resultadoFinal = x * y;
                break;
            case "/":
                if (y == 0) {
                    return "Divisão por zero não e valida";
                }
                resultadoFinal = x /y;
                break;
            default:
                return "Sinal inválido";
        }
        
        return String.valueOf(resultadoFinal);
    }
}
