<html>
<head>
    <meta charset="UTF-8">
    <title>Acesso Ficha ldl</title>
    <link rel="stylesheet" type="text/css" href="../Styles/ResetAll.css">
    <link rel="stylesheet" type="text/css" href="../Styles/index/Body.css">
    <link rel="stylesheet" type="text/css" href="../Styles/index/HeaderFooter.css">
</head>

<?php
require '../php/conexao.php';

session_start();

if(isset($_SESSION['usuario'])) {
    // Busca o ID do usuário logado
    $jogador = $_SESSION['id_jogador'];
    $sql = "SELECT personagem.id, nome 
            FROM base, personagem, jogador
            WHERE personagem.id_jogador = :id_jogador
            AND personagem.id = base.id_Personagem";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_jogador' => $jogador]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<body>
    <div class="container">
        <h2>Acessar personagens</h2>
        <div class="input_row">
            <?php if (count($result) > 0): ?>
                <ul>
                    <?php foreach($result as $row): ?>
                        <li>
                            <?php echo htmlspecialchars($row['nome']); ?>
                            <a href="acessarFicha.php?id_personagem=<?php echo $row['id']; ?>">Ver ficha</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Nenhum personagem encontrado.</p>
            <?php endif; ?>
        </div>
        <a href="index.php">Voltar para a página principal</a>
    </div>
</body>
</html>

<?php
} else {
?>

<body>
    <div class="container">
        <h2>Acessar personagens</h2>
        <form method="POST" action="acessarFicha.php">
            <div class="input_row">
                <p>Log-in necessário para acessar os personagens.</p>
            </div>
        </form>
        <a href="index.php">Voltar para a página principal</a>
        <a href="login.php">Log-in na conta</a>
    </div>
</body>
</html>


<?php

}
?>
