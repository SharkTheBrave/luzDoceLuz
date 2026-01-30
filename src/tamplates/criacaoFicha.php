<html>
<head>
    <meta charset="UTF-8">
    <title>Ficha de Personagem</title>
    <link rel="stylesheet" type="text/css" href="../Styles/ResetAll.css">
    <link rel="stylesheet" type="text/css" href="../Styles/criacaoFicha/Body.css">
    <link rel="stylesheet" type="text/css" href="../Styles/criacaoFicha/HeaderFooter.css">
    <script src="src/js/mostrar.js"></script>

</head>
<body>
    <div class="container">
    <h1>Ficha de Personagem</h1>

<?php
session_start();

    if (!isset($_SESSION['id_jogador'])){
        echo "<a href=cadastro.php> Você precisa estar cadastrado para criar seu personagem! </a>";
    } else{
        
?>
    <form method="POST" action="../php/criarFicha.php" id="acesso">        
        <!-- Dados Base -->
         
        <h2>Dados Base</h2>
        
        <div class="input_row base">
        <p>Nome do personagem:</p>
        <input type="text" name="personagem" required><br><br>      
        </div>
        <div class="input_row base">
        <p>Idade:</p>
        <input type="number" name="idade" required><br><br>
        </div>
        <div class="input_row base">
        <p>Gênero:</p>
        <input type="text" name="genero" required><br><br>
        </div>
        <div class="input_row base">
        <p>Altura:</p>
        <input type="text" name="altura" required><br><br>
        </div>
        <div class="input_row base">
        <p>Ocupação:</p>
        <input type="text" name="ocupacao" required><br><br>
        </div>
        <div class="input_row base">
        <p>Residência:</p>
        <input type="text" name="residencia" required><br><br>
        </div>
        <div class="input_row base">
        <p>Nacionalidade:</p>
        <input type="text" name="nacionalidade" required><br><br>
        </div>
        <div class="input_row base">
        <p>Arquétipo:</p>
        <input type="text" name="arquetipo" required><br><br>
        </div>
        <div class="input_row base">
        <p>Sina:</p>
        <input type="text" name="sina" required><br><br>
        </div>
        <div class="input_row base">
        <p>Nível:</p>
        <input type="number" name="nivel" required><br><br>
        </div>
        <div class="input_row base">
        <p>Pontos Armazenados:</p>
        <input type="number" name="pontos_armazenados" required><br><br>
        </div>
        <div class="input_row base">
        <p>Contato:</p>
        <input type="number" name="contato" required><br><br>
        </div>
        <hr>

        <!-- Atributos -->
        <h2>Atributos</h2>
        <div class="input_row">
        <p>Força:</p>
        <input class="input_square" type="number" name="forca" ><br><br>
        </div>

        <div class="input_row">
        <p>Agilidade:</p>
        <input class="input_square" type="number" name="agilidade" ><br><br>
        </div>

        <div class="input_row">
        <p>Constituição:</p>
        <input class="input_square" type="number" name="constituicao" ><br><br>
        </div>

        <div class="input_row">
        <p>Mente:</p>
        <input class="input_square" type="number" name="mente" ><br><br>
        </div>

        <div class="input_row">
        <p>Determinação:</p>
        <input class="input_square" type="number" name="determinacao" ><br><br>
        </div>

        <div class="input_row">
        <p>Carisma:</p>
        <input class="input_square" type="number" name="carisma" ><br><br>
        </div>

        <hr>

        
        <!-- Perícias -->
        <h2>Perícias</h2>

        <div class="input_row">
        <p>Acrobacia:</p>
        <input class="input_square" type="number" name="acrobacia" ><br><br>
        </div>

        <div class="input_row">
        <p>Adestramento:</p>
        <input class="input_square" type="number" name="adestramento" ><br><br>
        </div>

        <div class="input_row">
        <p>Atletismo:</p>
        <input class="input_square" type="number" name="atletismo" ><br><br>
        </div>

        <div class="input_row">
        <p>Atuação:</p>
        <input class="input_square" type="number" name="atuacao" ><br><br>
        </div>

        <div class="input_row">
        <p>Conhecimento:</p>
        <input class="input_square" type="number" name="conhecimento" ><br><br>
        </div>

        <div class="input_row">
        <p>Enganação:</p>
        <input class="input_square" type="number" name="enganacao" ><br><br>
        </div>

        <div class="input_row">
        <p>Fortitude:</p>
        <input class="input_square" type="number" name="fortitude" ><br><br>
        </div>

        <div class="input_row">
        <p>Furtividade:</p>
        <input class="input_square" type="number" name="furtividade" ><br><br>
        </div>

        <div class="input_row">
        <p>História:</p>
        <input class="input_square" type="number" name="historia" ><br><br>
        </div>

        <div class="input_row">
        <p>Iniciativa:</p>
        <input class="input_square" type="number" name="iniciativa" ><br><br>
        </div>

        <div class="input_row">
        <p>Intimidação:</p>
        <input class="input_square" type="number" name="intimidacao" ><br><br>
        </div>

        <div class="input_row">
        <p>Intuição:</p>
        <input class="input_square" type="number" name="intuicao" ><br><br>
        </div>

        <div class="input_row">
        <p>Investigação:</p>
        <input class="input_square" type="number" name="investigacao" ><br><br>
        </div>

        <div class="input_row">
        <p>Jogatina:</p>
        <input class="input_square" type="number" name="jogatina" ><br><br>
        </div>

        <div class="input_row">
        <p>Ladinagem:</p>
        <input class="input_square" type="number" name="ladinagem" ><br><br>
        </div>

        <div class="input_row">
        <p>Luta:</p>
        <input class="input_square" type="number" name="luta" ><br><br>
        </div>

        <div class="input_row">
        <p>Misticismo:</p>
        <input class="input_square" type="number" name="misticismo" ><br><br>
        </div>

        <div class="input_row">
        <p>Medicina:</p>
        <input class="input_square" type="number" name="medicina" ><br><br>
        </div>

        <div class="input_row">
        <p>Nobreza:</p>
        <input class="input_square" type="number" name="nobreza" ><br><br>
        </div>

        <div class="input_row">
        <p>Ofício:</p>
        <input class="input_square" type="number" name="oficio" ><br><br>
        </div>

        <div class="input_row">
        <p>Percepção:</p>
        <input class="input_square" type="number" name="percepcao" ><br><br>
        </div>

        <div class="input_row">
        <p>Pilotagem:</p>
        <input class="input_square" type="number" name="pilotagem" ><br><br>
        </div>

        <div class="input_row">
        <p>Pontaria:</p>
        <input class="input_square" type="number" name="pontaria" ><br><br>
        </div>

        <div class="input_row">
        <p>Reflexos:</p>
        <input class="input_square" type="number" name="reflexos" ><br><br>
        </div>

        <div class="input_row">
        <p>Religião:</p>
        <input class="input_square" type="number" name="religiao" ><br><br>
        </div>

        <div class="input_row">
        <p>Sobrevivência:</p>
        <input class="input_square" type="number" name="sobrevivencia" ><br><br>
        </div>

        <div class="input_row">
        <p>Vontade:</p>
        <input class="input_square" type="number" name="vontade" ><br><br>
        </div>

        <br><br>
        <button type="submit" value="SalvarFichaCompleta"> Salvar </button>
        <br><br>
        <a href="index.php">Voltar para a página principal</a>
    </form>
    </div>

<?php
    }
?>


</body>
</html>
