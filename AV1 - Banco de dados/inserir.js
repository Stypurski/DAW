function mudarTipo(tipo){
  
    document.getElementById("tipo").value = tipo;
    const label = document.getElementById("labelPergunta");
    const grupoOpcoes = document.getElementById("grupoOpcoes");
    const camposOpcoes = ["opcoesA", "opcoesB", "opcoesC", "opcoesD", "opcoesE"];

    if(tipo=== "multipla"){
      
        label.textContent = "Pergunta (MULTIPLA):";
        grupoOpcoes.style.display = "block";
        camposOpcoes.forEach(id => document.getElementById(id).required = true);
      
    }else{
      
        label.textContent = "Pergunta (TEXTO):";
        grupoOpcoes.style.display = "none";
        camposOpcoes.forEach(id => document.getElementById(id).required = false);
    }
}


document.getElementById("formInserir").addEventListener("submit", function (e){
  
    e.preventDefault();

    const formData = new FormData(this);

    fetch("inserir.php", { method: "POST", body: formData })
        .then(response => response.json())
        .then(resposta =>{
            const msg = document.getElementById("mensagem");
            msg.textContent = resposta.mensagem;
            msg.style.display = "block";

            this.reset();
            mudarTipo("multipla");
          
        });
});
