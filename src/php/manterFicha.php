<?php
require 'conexao.php';
if(isset($_POST['edit'])){
try {
    $pdo->beginTransaction();
    
    // Atualizar os dados base do personagem
    $stmt = $pdo->prepare("
        UPDATE base
        SET nome = :nome, idade = :idade, genero = :genero, altura = :altura,
            ocupacao = :ocupacao, residencia = :residencia, nacionalidade = :nacionalidade,
            arquetipo = :arquetipo, sina = :sina, nivel = :nivel,
            pontos_armazenados = :pontos_armazenados, contato = :contato
        WHERE id_personagem = :id_personagem
    ");
    $stmt->execute([
        ':nome' => $_POST['personagem'],
        ':idade' => $_POST['idade'],
        ':genero' => $_POST['genero'],
        ':altura' => $_POST['altura'],
        ':ocupacao' => $_POST['ocupacao'],
        ':residencia' => $_POST['residencia'],
        ':nacionalidade' => $_POST['nacionalidade'],
        ':arquetipo' => $_POST['arquetipo'],
        ':sina' => $_POST['sina'],
        ':nivel' => $_POST['nivel'],
        ':pontos_armazenados' => $_POST['pontos_armazenados'],
        ':contato' => $_POST['contato'],
        ':id_personagem' => $_GET['id_personagem']
    ]);

    // Atualizar os atributos do personagem
    $atributos = ['força', 'agilidade', 'constituição', 'mente', 'determinação', 'carisma'];
    foreach ($atributos as $atributo) {
        $stmt = $pdo->prepare("
            UPDATE atributo
            INNER JOIN tipo_atributo ON atributo.id_tipo_atributo = tipo_atributo.id
            SET valor = :valor
            WHERE atributo.id_personagem = :id_personagem AND tipo_atributo.nome = :nome
        ");
        $stmt->execute([
            ':valor' => $_POST[$atributo],
            ':id_personagem' => $_GET['id_personagem'],
            ':nome' => ucfirst($atributo)
        ]);
    }

    // Atualizar as perícias do personagem
    $pericias = [
        'acrobacia', 'adestramento', 'atletismo', 'atuação', 'conhecimento', 'enganação',
        'fortitude', 'furtividade', 'histiória', 'iniciativa', 'intimidação', 'intuição',
        'investigação', 'jogatina', 'ladinagem', 'luta', 'misticismo', 'medicina',
        'nobreza', 'ofício', 'percepção', 'pilotagem', 'pontaria', 'reflexos',
        'religião', 'sobrevivência', 'vontade'
    ];
    foreach ($pericias as $pericia) {
        $stmt = $pdo->prepare("
            UPDATE pericia
            INNER JOIN tipo_pericia ON pericia.id_tipo_pericia = tipo_pericia.id
            SET valor = :valor
            WHERE pericia.id_personagem = :id_personagem AND tipo_pericia.nome = :nome
        ");
        $stmt->execute([
            ':valor' => $_POST[$pericia],
            ':id_personagem' => $_GET['id_personagem'],
            ':nome' => $pericia
        ]);
    }

    $pdo->commit();
    header("Location: ../../acessarFicha.php?id_personagem=" . $_GET['id_personagem']);

} catch (Exception $e) {
    $pdo->rollBack();
    echo "Erro ao salvar os dados: " . $e->getMessage();
}
} else {
    if(isset($_POST['delete'])){
        try {
            $pdo->beginTransaction();
            $id = $_GET['id_personagem'];

            $stmt = $pdo->prepare("DELETE FROM personagem WHERE id = :id_personagem");
            $stmt->execute([':id_personagem' => $id]);

            $stmt = $pdo->prepare("DELETE FROM base WHERE id_personagem = :id_personagem");
            $stmt->execute([':id_personagem' => $id]);

            $stmt = $pdo->prepare("DELETE FROM atributo WHERE id_personagem = :id_personagem");
            $stmt->execute([':id_personagem' => $id]);

            $stmt = $pdo->prepare("DELETE FROM pericia WHERE id_personagem = :id_personagem");
            $stmt->execute([':id_personagem' => $id]);
            $pdo->commit();

                header("Location: ../../index.php?deleted=1");

        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Erro ao deletar o personagem: " . $e->getMessage();
        }
    } else {
        echo "Nenhuma ação foi selecionada.";
    }
}
?>