<html>
<head>
    <meta charset="UTF-8">
    <title>Ficha de Personagem</title>
    <link rel="stylesheet" type="text/css" href="../Styles/ResetAll.css">
    <link rel="stylesheet" type="text/css" href="../Styles/cadastro/Body.css">
    <link rel="stylesheet" type="text/css" href="../Styles/cadastro/HeaderFooter.css">
</head>
<body>
<div class="container">
<h2>Cadastro</h2>
       <form method="POST" action="cadastro.php">
        Jogador:<br>
        <input type="text" name="jogador" required><br><br>

        Senha:<br>
        <input type="password" name="senha" required><br><br>

        <button type="submit"> Salvar </button>
        </form>
        <a href="login.php">Já está cadastrado? Faça o seu login.</a>
        <a href="index.html">Voltar para a página principal.</a>


<?php
require 'src/php/conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $pdo->beginTransaction();

        $jogador = $_POST["jogador"];
        $senha = $_POST["senha"];

        $stmt = $pdo->prepare("INSERT INTO jogador (usuario, senha) VALUES (:jogador, :senha)");

        $stmt->execute([
            ':jogador' => $jogador,
            ':senha' => $senha
        ]);

        $pdo->commit();

        header("Location: index.php");
    } catch (PDOException $e) {
        $pdo->rollBack();

        if ($e->getCode() == 23000) {
            echo "<h2>Nome de usuário em uso, tente usar outro nome!</h2>";
        } else {
            echo "Erro ao salvar cadastro: " . $e->getMessage();
        }
    }
}
?>
</div>
</body>
</html>