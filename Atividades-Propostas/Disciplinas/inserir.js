document.getElementById("formInserir").addEventListener("submit", function (e){
  
    e.preventDefault();

    const form  = document.getElementById("formInserir");
    const formData = new FormData(form);
    
    fetch("inserir_materia.php", { method: "POST", body: formData })
        .then(response => response.json())
        .then(resposta =>{
            const msg = document.getElementById("mensagem");
            msg.textContent = resposta.mensagem;
            msg.style.display = "block";

            this.reset();
          
        });
});
