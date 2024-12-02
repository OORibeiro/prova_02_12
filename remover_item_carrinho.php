<?php
session_start();
include('conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$produto_id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Garantir que o ID seja um número inteiro

// Verificar se o produto_id é válido
if ($produto_id <= 0) {
    echo "Produto inválido!";
    exit();
}

// Buscar o carrinho 'ativo' do usuário
$query = "SELECT * FROM carrinho WHERE usuario_id = ? AND status = 'ativo'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $carrinho = $result->fetch_assoc();
    $carrinho_id = $carrinho['id'];

    // Remover o produto do carrinho
    $query = "DELETE FROM carrinho_produtos WHERE carrinho_id = ? AND produto_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $carrinho_id, $produto_id);

    if ($stmt->execute()) {
        // Redirecionar após a remoção com uma mensagem de sucesso
        header("Location: exibir_carrinho.php?msg=Produto removido com sucesso");
        exit();
    } else {
        echo "Erro ao remover o produto: " . $conn->error;
    }
} else {
    echo "Carrinho não encontrado ou já finalizado.";
}
?>
