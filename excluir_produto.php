<?php
session_start();
include('conexao.php');
include('verifica_sessao.php'); 

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit();
}

// Obter o tipo do usuário logado
$id = $_SESSION['usuario_id'];
$query = "SELECT tipo_usuario FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if ($usuario['tipo_usuario'] !== 'admin') {
    // Redirecionar para página de erro ou página inicial
    header("Location: index.php");
    exit();
}



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir produto
    $sql = "DELETE FROM produtos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Produto excluído com sucesso!";
        header("Location: index.php");
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>


