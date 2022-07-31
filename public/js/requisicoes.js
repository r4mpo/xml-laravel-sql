const token = document.querySelector('meta[name="csrf-token"]').content // Referenciando o TOKEN
buscarMercadoriasTable() // Atualizando a table assim que a página é carregada

// Enviar Dados XML recebidos pelo modal
function EnviarDados(){

    // Campo de NFE do formulário
    // Iniciando formData para enviar arquivos

    let nfe = document.getElementById('nfe')
    let formData = new FormData()
    formData.append("nfe", nfe.files[0])

    // O fetch vai definir a rota. No caso
    // é nossa rota definida no arquivo de rotas
    // e no controller

    fetch(`/mercadorias/storexml`, {
        method: 'POST',
        headers: {
            contentType: false,
            processData: false,
            "X-CSRF-Token": token
        },
        body: formData
    })

    // Tentará trazer o dados (neste caso, a resposta da requisição)
    .then(response => response.json())
    .then(data => {
        alert(data.resposta)
    })
    .catch(error => console.log(error)) // Mensagem caso retorne erro
    buscarMercadoriasTable() // Atualizando a tabela para incluir o novo dado
}

// Inserindo os dados na tabela
function buscarMercadoriasTable(){    

    // Definindo a tabela
    let tabela = document.getElementById('tabela')  

    // O fetch é feito com o método get, 
    // então não é necessário body, apenas
    // acessaremos os dados.
    fetch(`/mercadorias/buscarMercadorias`, {
        headers: {
            "Content-Type": "application/json; charset=utf-8",
            "X-CSRF-Token": token
        },
        method: 'GET',
    })

    // Tentará trazer os dados e inseri-los na tabela
    .then(response => response.json())
    .then(data => {
        tabela.innerHTML = ''
        data.dados.forEach(item => {
            tabela.innerHTML += `<td scope="row">${item.id}</td>
            <td>${item.title}</td>
            <td>R$${item.value}</td>
            <td>${item.codigo}</td>
            <td>${item.fk_categoria_1}</td>
            <td>${item.fk_categoria_2}</td>
            <td>${item.fk_categoria_3}</td>
            <td><a button type="button" class="btn btn-primary" href="/mercadorias/edit/${item.id}"><ion-icon name="pencil-outline"></ion-icon></a></button></td>
            <td><button type="button" class="btn btn-danger" onClick="deletarMercadorias(${item.id})"><ion-icon name="trash-outline"></ion-icon></button></td>`
        })
    })
    .catch(error => console.log(error)) // Retornando mensagem de erro
}

// Função para deletar os dados
function deletarMercadorias(id)
{
    fetch(`/mercadorias/delete/` + id, 
    {
        method: 'DELETE',
        headers: 
        {
            'Accept': 'application/json',
            "Content-Type": "application/json; charset=UTF-8",
            "X-CSRF-Token": token
        }
    })
    // Tentará trazer o dados (neste caso, a resposta da requisição)
    .then(response => response.json())
    .then(data => {
        alert(data.resposta)
    })
    .catch(error => console.log(error)) // Mensagem caso retorne erro
    buscarMercadoriasTable() // Atualizando a tabela para incluir o novo dado
}

// Inserindo os dados no select
function buscarCategorias(campoEmQuestao){    

    // Definindo o select
    let selectCategoria = document.getElementById(campoEmQuestao)  

    // O fetch é feito com o método get, 
    // então não é necessário body, apenas
    // acessaremos os dados.
    fetch(`/mercadorias/buscarCategorias`, {
        headers: {
            "Content-Type": "application/json; charset=utf-8",
            "X-CSRF-Token": token
        },
        method: 'GET',
    })

    // Tentará trazer os dados e inseri-los no select
    .then(response => response.json())
    .then(data => {
        selectCategoria.innerHTML += `<option value="">Selecione uma categoria</option>`
        data.dados.forEach(item => {
            selectCategoria.innerHTML += `
            <option value="${item.id}">${item.title}</option>
            `
        })
    })
    .catch(error => console.log(error)) // Retornando mensagem de erro
}

// Esta função verificará se o campo está
// habilitado ou desabilitado e, posteriormente,
// fará o oposto da situação atual
function geracaoAutomatica(x){

    let campo = document.getElementById(x)

    // Se houver valor no campo, ele não vai desabilitar

    if(campo.value){
        alert('Impossível gerar automaticamente. Remova os dados do campo e tente novamente.')
    }else{
        if(campo.hasAttribute('disabled')){
            campo.removeAttribute('disabled', 'disabled')
        }else{
            campo.setAttribute('disabled', 'disabled')
        }
    }
}

// Função para desabilitar CheckBox,
// só desabilita se o campo de texto estiver vazio
function disabledCb(){
    let codigo = document.getElementById('codigo')
    let checkBox = document.getElementById('cbGeracaoAutomatica')
    if(codigo.value){
        checkBox.setAttribute('disabled', 'disabled')
        checkBox.checked = false
    }else{
        checkBox.removeAttribute('disabled', 'disabled')
    }
}