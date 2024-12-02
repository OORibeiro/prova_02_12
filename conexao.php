<?php
$servername = "localhost";  // Servidor de banco de dados
$username = "root";         // Nome de usuário
$password = "usbw";             // Senha
$dbname = "bd_site";    // Nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
