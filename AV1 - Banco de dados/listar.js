let listaPerguntas = [];

window.onload = function(){

    carregarPerguntas();
};

function carregarPerguntas(){
  
    fetch("listar.php")
        .then(response => response.json())
        .then(dados => {
            listaPerguntas = dados;
            const tbody = document.getElementById("tabelaPerguntas");
            tbody.innerHTML = "";

            if(dados.length === 0){
                tbody.innerHTML = '<tr><td colspan="4">Nenhuma pergunta cadastrada.</td></tr>';
                return;
            }

            dados.forEach((p, i) =>{
                tbody.innerHTML += `
                    <tr>
                        <td>${p.numero}</td>
                        <td>${p.pergunta}</td>
                        <td>${p.tipo.toUpperCase()}</td>
                        <td>
                            <a href="#" onclick="verDetalhes(${i}); return false;">Visualizar</a>
                            <a href="#" onclick="prepararEdicao(${i}); return false;">Editar</a>
                            <a href="#" onclick="excluirPergunta(${p.numero}); return false;">Excluir</a>
                        </td>
                    </tr>
                `;
            });
        });
}

function verDetalhes(posicaoArray){
  
    fecharEdicao();
    const p = listaPerguntas[posicaoArray];

    document.getElementById("detNumero").textContent = p.numero;
    document.getElementById("detPergunta").textContent = p.pergunta;
    document.getElementById("detTipo").textContent = p.tipo.toUpperCase();
    document.getElementById("detResposta").textContent = p.resposta;

    const blocoOpcoes = document.getElementById("detBlocoOpcoes");

    if(p.tipo === "multipla"){
      
        blocoOpcoes.style.display = "block";
        document.getElementById("detOpA").textContent = p.opcoes[0] || "";
        document.getElementById("detOpB").textContent = p.opcoes[1] || "";
        document.getElementById("detOpC").textContent = p.opcoes[2] || "";
        document.getElementById("detOpD").textContent = p.opcoes[3] || "";
        document.getElementById("detOpE").textContent = p.opcoes[4] || "";
    }else{
      
        blocoOpcoes.style.display = "none";
    }

    document.getElementById("boxDetalhes").style.display = "block";
  
}

function fecharDetalhes(){
  
    document.getElementById("boxDetalhes").style.display = "none";
}


function prepararEdicao(posicaoArray){
  
    if(!confirm("Deseja editar esta pergunta")){
        return;
    }

    fecharDetalhes();
    const p = listaPerguntas[posicaoArray];

    document.getElementById("tituloEditNum").textContent = p.numero;
    document.getElementById("editNumero").value = p.numero;
    document.getElementById("editTipo").value = p.tipo;
    document.getElementById("editPergunta").value = p.pergunta;
    document.getElementById("editResposta").value = p.resposta;

    const grupo = document.getElementById("grupoOpcoesEdit");
    const campos = ["editOpA", "editOpB", "editOpC", "editOpD", "editOpE"];

    if(p.tipo === "multipla"){
      
        grupo.style.display = "block";
        document.getElementById("editOpA").value = p.opcoes[0] || "";
        document.getElementById("editOpB").value = p.opcoes[1] || "";
        document.getElementById("editOpC").value = p.opcoes[2] || "";
        document.getElementById("editOpD").value = p.opcoes[3] || "";
        document.getElementById("editOpE").value = p.opcoes[4] || "";
        campos.forEach(id => document.getElementById(id).required = true);
    }else{
      
        grupo.style.display = "none";
        campos.forEach(id => document.getElementById(id).required = false);
    }

    document.getElementById("boxEditar").style.display = "block";
}

function fecharEdicao(){
  
    document.getElementById("boxEditar").style.display = "none";
}

document.getElementById("formEditar").addEventListener("submit", function (e){
  
    e.preventDefault();

    const formData = new FormData(this);

    fetch("editar.php", { method: "POST", body: formData })
        .then(response => response.json())
        .then(resposta => {
            const msg = document.getElementById("mensagemAviso");
            msg.textContent = resposta.mensagem;
            msg.style.display = "block";

            fecharEdicao();
            carregarPerguntas();
        });
});


function excluirPergunta(numero){
  
    if(!confirm("Deseja excluir esta pergunta?")){
        return;
    }

  
    fetch("excluir.php?numero=" + numero)
        .then(response => response.json())
        .then(resposta => {
            const msg = document.getElementById("mensagemAviso");
            msg.textContent = resposta.mensagem;
            msg.style.display = "block";

            fecharDetalhes();
            fecharEdicao();
            carregarPerguntas();
        });
  
}
