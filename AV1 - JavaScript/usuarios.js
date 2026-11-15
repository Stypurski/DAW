let listaUsuarios = [];

window.onload = function(){
    carregarUsuarios();
};

function carregarUsuarios(){
    fetch("listar_usuarios.php").then(response => response.json()).then(dados =>{
            listaUsuarios = dados;
            const tbody = document.getElementById("tabelaUsuarios");
            tbody.innerHTML = "";

            if(dados.length === 0){
                tbody.innerHTML= '<tr><td colspan="4">Nao existe nenhum cadastro de usuario</td></tr>';
                return;
            }

            dados.forEach((usu, i)=>{
                tbody.innerHTML += `
                    <tr>
                        <td>${usu.index + 1}</td>
                        <td>${usu.nome}</td>
                        <td>${usu.email}</td>
                        <td>
                            <a href="#" onclick="prepararEdicao(${i}); return false;">Editar</a>
                            <a href="#" onclick="excluirUsuario(${usu.index}); return false;">Excluir</a>
                        </td>
                    </tr>
                `;
            });
        });
}

document.getElementById("formUsuario").addEventListener("submit", function(e){
  
    e.preventDefault();

    const formData = new FormData(this);
    const index = document.getElementById("index").value;

    const arquivoPHP= (index === "")? "inserir_usuario.php" : "editar_usuario.php";

    fetch(arquivoPHP,{ method: "POST", body: formData })
          .then(response => response.json())
          .then(resposta => {
            mostrarMensagem(resposta.mensagem);
            
        document.getElementById("formUsuario").reset();
        document.getElementById("index").value = "";
        document.getElementById("btnSalvar").value = "Cadastrar usuario";

        carregarUsuarios();
    });
});

function prepararEdicao(posicaoArray) {
    const usu = listaUsuarios[posicaoArray];
    document.getElementById("index").value = usu.index;
    document.getElementById("nome").value = usu.nome;
    document.getElementById("email").value = usu.email;
    document.getElementById("btnSalvar").value = "Salvar";
}

function excluirUsuario(index) {
    fetch("excluir_usuario.php?excluir=" + index)
        .then(response => response.json())
        .then(resposta => {
            mostrarMensagem(resposta.mensagem);
            carregarUsuarios();
        });
}

function mostrarMensagem(texto) {
    const msg = document.getElementById("mensagem");
    msg.textContent = texto;
    msg.style.display = "block";
}
