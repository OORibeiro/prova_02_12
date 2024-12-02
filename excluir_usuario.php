<?php
session_start();
include('conexao.php');
include('verifica_sessao.php'); 

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['usuario_id'];

// Excluir a conta do usuário
$query = "DELETE FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Finalizar a sessão e redirecionar para a página inicial
    session_destroy();
    header("Location: index.php");
} else {
    echo "Erro ao excluir a conta.";
}
?>
