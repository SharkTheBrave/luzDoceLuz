<?php
require 'conexao.php';

try {
    $pdo->beginTransaction();
    session_start();

    $id_jogador = $_SESSION['id_jogador'];

     $stmt = $pdo->prepare("INSERT INTO personagem (id_jogador) VALUES (:id_jogador)");
     $stmt->execute([':id_jogador' => $id_jogador]);
 

     $id_personagem = $pdo->lastInsertId();
     

    // Dados base
    $stmt = $pdo->prepare("INSERT INTO base (
        id_personagem, nome, idade, genero, altura, ocupacao, residencia, nacionalidade,
        arquetipo, sina, nivel, pontos_armazenados, contato
    ) VALUES (
        :id_personagem, :nome, :idade, :genero, :altura, :ocupacao, :residencia, :nacionalidade,
        :arquetipo, :sina, :nivel, :pontos_armazenados, :contato
    )");

    $stmt->execute([
        ':id_personagem' => $id_personagem,
        ':nome' => $_POST['personagem'] ?? '',
        ':idade' => $_POST['idade'] ?? null,
        ':genero' => $_POST['genero'] ?? '',
        ':altura' => $_POST['altura'] ?? '',
        ':ocupacao' => $_POST['ocupacao'] ?? '',
        ':residencia' => $_POST['residencia'] ?? '',
        ':nacionalidade' => $_POST['nacionalidade'] ?? '',
        ':arquetipo' => $_POST['arquetipo'] ?? '',
        ':sina' => $_POST['sina'] ?? '',
        ':nivel' => $_POST['nivel'] ?? null,
        ':pontos_armazenados' => $_POST['pontos_armazenados'] ?? null,
        ':contato' => $_POST['contato'] ?? null,
    ]);

    echo "<h2>Dados base salvos com sucesso!</h2>";

    $pdo->commit();

    // Atributos
    $atributos = ['forca', 'agilidade', 'constituicao', 'mente', 'determinacao', 'carisma'];
    foreach ($atributos as $atributo) {
        $stmt = $pdo->prepare("
            INSERT INTO atributo (id_personagem, id_tipo_atributo, valor)
            SELECT :id_personagem, id, :valor
            FROM tipo_atributo
            WHERE nome = :nome
        ");
        $stmt->execute([
            ':id_personagem' => $id_personagem,
            ':valor' => $_POST[$atributo] ?? 0,
            ':nome' => ucfirst($atributo)
        ]);
    }

    echo "<h2>Atributos salvos com sucesso!</h2>";

    // Perícias
    $pericias = [
        'acrobacia', 'adestramento', 'atletismo', 'atuacao', 'conhecimento', 'enganacao',
        'fortitude', 'furtividade', 'historia', 'iniciativa', 'intimidacao', 'intuicao',
        'investigacao', 'jogatina', 'ladinagem', 'luta', 'misticismo', 'medicina',
        'nobreza', 'oficio', 'percepcao', 'pilotagem', 'pontaria', 'reflexos',
        'religiao', 'sobrevivencia', 'vontade'
    ];
    foreach ($pericias as $pericia) {
        $stmt = $pdo->prepare("
            INSERT INTO pericia (id_personagem, id_tipo_pericia, valor)
            SELECT :id_personagem, id, :valor
            FROM tipo_pericia
            WHERE nome = :nome
        ");
        $stmt->execute([
            ':id_personagem' => $id_personagem,
            ':valor' => $_POST[$pericia] ?? 0,
            ':nome' => ucfirst($pericia)
        ]);
    }

    header("Location: ../../acessarFicha.php?id_personagem=" . urlencode($id_personagem));
} catch (Exception $e) {
    error_log("Erro ao salvar os dados: " . $e->getMessage()); 
    echo "<h2>Erro ao salvar os dados. Por favor, <a href='criacaoFicha.php'>tente novamente</a>.</h2>";
}
?>