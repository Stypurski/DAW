async function calcular(){
    
    const x = parseFloat(document.getElementById('x').value);
    const y = parseFloat(document.getElementById('y').value);
    const sinal = document.getElementById('sinal').value;
    const resultadoDiv = document.getElementById('resultado');
    
    if(isNaN(x) || isNaN(y)){
        resultadoDiv.innerText = "Preencha todos os campos com dados válidos";
        return;
    }
    
    try{
        
        const response = await fetch(`http://localhost:8080/api/calcular?x=${x}&y=${y}&sinal=${encodeURIComponent(sinal)}`);
        
        if (!response.ok) {
            throw new Error("Erro na resposta do servidor.");
        }
        
        const resultado = await response.text();
        
        resultadoDiv.innerText = `Resultado : ${resultado}`;
    }catch(error){
        resultadoDiv.innerText = "Erro ao conectar no servidor";
        console.error("Erro de requisicao: ", error);
    }
}
