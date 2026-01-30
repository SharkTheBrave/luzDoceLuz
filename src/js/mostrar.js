function mostrarMaisEMenos(informacaoId, botaoId) {
    var informacaoElement = document.getElementById(informacaoId);
    var botaoElement = document.getElementById(botaoId);
    if (informacaoElement.classList.contains("hidden")) {

        informacaoElement.classList.remove("hidden");
        informacaoElement.classList.add("inline-block");
        botaoElement.innerText = "Esconder " + informacaoElement.getAttribute('name');
    } else {
        informacaoElement.classList.remove("inline-block");
        informacaoElement.classList.add("hidden");
        botaoElement.innerText = "Ver " + informacaoElement.getAttribute('name');
    }
}

function mostrarEtapa(paginaAtual, proximaPaginaId) {
    var paginaAtualElement = document.getElementById(paginaAtual);
    var proximaPaginaIdElement = document.getElementById(proximaPaginaId);  
    paginaAtualElement.classList.remove("active");
    proximaPaginaIdElement.classList.add("active");
}