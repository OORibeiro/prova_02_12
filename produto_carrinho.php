<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    // Buscar carrinho ativo
    $query = "SELECT * FROM carrinho WHERE usuario_id = ? AND status = 'ativo'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Carrinho ativo encontrado
        $carrinho = $result->fetch_assoc();
        $carrinho_id = $carrinho['id'];

        // Verificar se o produto já existe no carrinho
        $query = "SELECT * FROM carrinho_produtos WHERE carrinho_id = ? AND produto_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $carrinho_id, $produto_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Produto já existe no carrinho, atualizar a quantidade
            $query = "UPDATE carrinho_produtos SET quantidade = quantidade + ? WHERE carrinho_id = ? AND produto_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iii", $quantidade, $carrinho_id, $produto_id);
        } else {
            // Produto não existe no carrinho, adicionar novo
            $query = "INSERT INTO carrinho_produtos (carrinho_id, produto_id, quantidade) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iii", $carrinho_id, $produto_id, $quantidade);
        }

        if ($stmt->execute()) {
            echo "Produto adicionado ao carrinho!";
            header("Location: exibir_carrinho.php");
            exit();
        } else {
            echo "Erro ao adicionar ao carrinho: " . $conn->error;
        }
    } else {
        echo "Nenhum carrinho ativo encontrado.";
    }
}
?>
