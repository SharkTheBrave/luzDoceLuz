<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="src/Styles/ResetAll.css">
    <link rel="stylesheet" type="text/css" href="src/Styles/login/Body.css">
    <link rel="stylesheet" type="text/css" href="src/Styles/login/header-footer.css">
</head>
<body>

    
    <div class="container">
        <h1>Login</h1>

        <form method="POST" action="loginTeste.php">
            <input type="text" name="usuario" placeholder="Usuário"></input>
            <input type="password" name="senha" placeholder="Senha"></input>
            <input type="submit" name="submit"></input>
        </form>
        <a href="index.php">Voltar para a página principal</a>
        <a href="cadastro.php">Não tem uma conta? Cadastre-se</a>

    </div>

</body>
</html>