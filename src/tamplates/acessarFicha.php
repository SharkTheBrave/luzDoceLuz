<?php
require '../php/conexao.php';


    session_start();
    try {

        $id_jogador = $_SESSION['id_jogador'];
        $id_personagem = $_GET['id_personagem'] ?? null;

        if (!$id_personagem) {
            throw new Exception("ID do personagem não informado.");
        }

        $stmt = $pdo->prepare("
            SELECT *
            FROM personagem
            INNER JOIN base ON base.id_personagem = personagem.id
            WHERE personagem.id_jogador = :id_jogador AND personagem.id = :id_personagem
        ");
        $stmt->execute([
            ':id_jogador' => $id_jogador,
            ':id_personagem' => $id_personagem
        ]);
        $personagem = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$personagem) {
            throw new Exception("Personagem não encontrado.");
        }

        $id_personagem = $personagem['id'];
        //tudo isso foi para pegar o id do personagem


        //base do personagem
        $stmt = $pdo->prepare("SELECT * FROM base WHERE id_personagem = :id_personagem");
        $stmt->execute([':id_personagem' => $id_personagem]);
        $dados_base = $stmt->fetch(PDO::FETCH_ASSOC);


        //atributos do personagem
        $stmt = $pdo->prepare("
            SELECT tipo_atributo.nome AS nome, atributo.valor AS valor
            FROM atributo
            INNER JOIN tipo_atributo ON atributo.id_tipo_atributo = tipo_atributo.id
            WHERE atributo.id_personagem = :id_personagem
        ");
        $stmt->execute([
            ':id_personagem' => $id_personagem
        ]);
        $atributos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $atributos[$row['nome']] = $row['valor'];
        }


        //pericias do personagem
        $stmt = $pdo->prepare("
        SELECT tipo_pericia.nome AS nome, pericia.valor AS valor
        FROM pericia
        INNER JOIN tipo_pericia ON pericia.id_tipo_pericia = tipo_pericia.id
        WHERE pericia.id_personagem = :id_personagem
        ");
        $stmt->execute([':id_personagem' => $id_personagem]);
        $pericias = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pericias[$row['nome']] = $row['valor'];
        }



    } catch (Exception $e) {
        echo "Erro ao acessar os dados: " . $e->getMessage();
        exit;
    }


?>



<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Ficha de Personagem</title>
    <link rel="stylesheet" type="text/css" href="../Styles/acessarFicha/Body.css">
    <link rel="stylesheet" type="text/css" href="../Styles/ResetAll.css">
    <link rel="stylesheet" type="text/css" href="../Styles/acessarFicha/HeaderFooter.css">
</head>
<body>
    <div class="container">
        <h1>Editar Ficha de Personagem</h1>
        <form method="POST" action="../php/manterFicha.php?id_personagem=<?= $id_personagem ?>">
            <!-- Dados Base -->
            <h2>Dados Base</h2>
            <div class="input_row base">
                <p>Nome do personagem:</p>
                <input type="text" name="personagem" value="<?= htmlspecialchars($dados_base['nome'] ?? '') ?>" required><br><br>
            </div>
            <div class="input_row base">
                <p>Idade:</p>
                <input type="number" name="idade" value="<?= htmlspecialchars($dados_base['idade'] ?? '') ?>" required><br><br>
            </div>
            <div class="input_row base">
                <p>Gênero:</p>
                <input type="text" name="genero" value="<?= htmlspecialchars($dados_base['genero'] ?? '') ?>" required><br><br>
            </div>
            <div class="input_row base">
                <p>Altura:</p>
                <input type="text" name="altura" value="<?= htmlspecialchars($dados_base['altura'] ?? '') ?>" required><br><br>
            </div>
            <div class="input_row base">
                <p>Ocupação:</p>
                <input type="text" name="ocupacao" value="<?= htmlspecialchars($dados_base['ocupacao'] ?? '') ?>" required><br><br>
            </div>
            <div class="input_row base">
                <p>Residência:</p>
                <input type="text" name="residencia" value="<?= htmlspecialchars($dados_base['residencia'] ?? '') ?>" required><br><br>
            </div>
            <div class="input_row base">
                <p>Nacionalidade:</p>
                <input type="text" name="nacionalidade" value="<?= htmlspecialchars($dados_base['nacionalidade'] ?? '') ?>" required><br><br>
            </div>
            <div class="input_row base">
                <p>Arquétipo:</p>
                <input type="text" name="arquetipo" value="<?= htmlspecialchars($dados_base['arquetipo'] ?? '') ?>" required><br><br>
            </div>
            <div class="input_row base">
                <p>Sina:</p>
                <input type="text" name="sina" value="<?= htmlspecialchars($dados_base['sina'] ?? '') ?>" required><br><br>
            </div>
            <div class="input_row base">
                <p>Nível:</p>
                <input type="number" name="nivel" value="<?= htmlspecialchars($dados_base['nivel'] ?? '') ?>" required><br><br>
            </div>
            <div class="input_row base">
                <p>Pontos Armazenados:</p>
                <input type="number" name="pontos_armazenados" value="<?= htmlspecialchars($dados_base['pontos_armazenados'] ?? '') ?>" required><br><br>
            </div>
            <div class="input_row base">
                <p>Contato:</p>
                <input type="number" name="contato" value="<?= htmlspecialchars($dados_base['contato'] ?? '') ?>" required><br><br>
            </div>
            <hr>

            <!-- Atributos -->
            <h2>Atributos</h2>
            <?php foreach (['força', 'agilidade', 'constituição', 'mente', 'determinação', 'carisma'] as $atributo): ?>
                <div class="input_row">
                    <p><?= ucfirst($atributo) ?>:</p>
                    <input class="input_square" type="number" name="<?= $atributo ?>" value="<?= htmlspecialchars($atributos[ucfirst($atributo)] ?? 0) ?>"><br><br>
                </div>
            <?php endforeach; ?>
            <hr>

            <!-- Perícias -->
            <h2>Perícias</h2>
            <?php foreach ([
                'acrobacia', 'adestramento', 'atletismo', 'atuação', 'conhecimento', 'enganação',
                'fortitude', 'furtividade', 'histiória', 'iniciativa', 'intimidação', 'intuição',
                'investigação', 'jogatina', 'ladinagem', 'luta', 'misticismo', 'medicina',
                'nobreza', 'ofício', 'percepção', 'pilotagem', 'pontaria', 'reflexos',
                'religião', 'sobrevivência', 'vontade'
            ] as $pericia): ?>
                <div class="input_row">
                    <p><?= ucfirst($pericia) ?>:</p>
                    <input class="input_square" type="number" name="<?= $pericia ?>" value="<?= htmlspecialchars($pericias[ucfirst($pericia)] ?? 0) ?>"><br><br>
                </div>
            <?php endforeach; ?>
            <br><br>
            <button type="submit" name="edit">Salvar Alterações</button>
            <button type="submit" name="delete">Excluir Ficha</button>
            <br><br>  
        </form>
        <a href="index.php">Voltar para a página principal</a>
    </div>
</body>
</html>