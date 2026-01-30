<?php
session_start();

if(!empty($_POST["usuario"]) && !empty($_POST["senha"])){
    require 'src/php/conexao.php';
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM jogador WHERE usuario = :usuario AND senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':usuario' => $usuario, ':senha' => $senha]);

    $jogador = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['id_jogador'] = $jogador['id'];
    $_SESSION['usuario'] = $jogador['usuario'];

    header("Location: index.php");

} else {
    echo "<h2>Por favor, preencha todos os campos.</h2>";
    echo "<a href='login.php'>Voltar para o login</a>";
}
?>