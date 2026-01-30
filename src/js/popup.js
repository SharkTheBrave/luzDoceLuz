function abrirPopupDeletar() {
    const newpopupWindow = window.open('', 'pagina', 'width=250,height=250');
    if (newpopupWindow) {
        newpopupWindow.document.write('Personagem deletado com sucesso!');
    }
}