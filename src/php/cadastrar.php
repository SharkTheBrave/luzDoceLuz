<?php
require 'conexao.php';

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

        echo "<h2>Cadastro salvo com sucesso!</h2>";
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