<?php
session_start();
include('conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Verificar se as quantidades foram enviadas
if (isset($_POST['quantidade']) && !empty($_POST['quantidade'])) {
    foreach ($_POST['quantidade'] as $produto_id => $quantidade) {
        // Validar a quantidade (não deve ser menor que 1)
        if ($quantidade >= 1) {
            // Atualizar a quantidade do produto no carrinho
            $query = "UPDATE carrinho_produtos SET quantidade = ? WHERE carrinho_id = (SELECT id FROM carrinho WHERE usuario_id = ? AND status = 'ativo') AND produto_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iii", $quantidade, $usuario_id, $produto_id);

            if (!$stmt->execute()) {
                echo "Erro ao atualizar a quantidade: " . $conn->error;
            }
        }
    }

    // Redireciona de volta para a página do carrinho para visualizar as alterações
    header("Location: exibir_carrinho.php?msg=Quantidades atualizadas com sucesso");
    exit();
} else {
    echo "Nenhuma quantidade foi fornecida para atualizar.";
}
?>
