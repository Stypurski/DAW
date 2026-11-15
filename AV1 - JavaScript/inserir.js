function mudarTipo(novoTipo){
  
    document.getElementById("tipo").value =novoTipo;
    document.getElementById("labelPergunta").textContent ="Pergunta (" + novoTipo.toUpperCase() + "):";

    const grupoOpcoes= document.getElementById("grupoOpcoes");
    const campos= ["opcoesA", "opcoesB", "opcoesC", "opcoesD", "opcoesE"];

    if(novoTipo=== "multipla"){
        grupoOpcoes.style.display = "block";
        campos.forEach(id =>{ document.getElementById(id).required = true; });
    }else{
        grupoOpcoes.style.display = "none";
        campos.forEach(id =>{ document.getElementById(id).required = false; });
    }
}

document.getElementById("formInserir").addEventListener("submit", function (e){
  
    e.preventDefault();
    const formData = new FormData(this);

    fetch("inserir.php",{ method: "POST", body: formData })
      
    .then(response=> response.json())
    .then(resposta=>{
        const msg = document.getElementById("mensagem");
        msg.textContent = resposta.mensagem;
        msg.style.display = "block";

        this.reset();
        mudarTipo("multipla");
    });
});
