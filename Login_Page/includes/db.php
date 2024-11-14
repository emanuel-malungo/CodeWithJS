<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

try {
    // Cria uma nova conexão PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configura o PDO para lançar exceções em caso de erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
}
?>
