<?php
$host = 'localhost';
$db = 'ldlbd';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>