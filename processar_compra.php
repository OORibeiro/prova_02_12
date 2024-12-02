<?php
session_start();
include('conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Obter dados do formulário de entrega
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$cep = $_POST['cep'];
$pagamento = $_POST['pagamento'];

// Buscar o carrinho 'ativo' do usuário
$query = "SELECT * FROM carrinho WHERE usuario_id = ? AND status = 'ativo'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $carrinho = $result->fetch_assoc();
    $carrinho_id = $carrinho['id'];

    // Criar o pedido
    $query = "INSERT INTO pedidos (usuario_id, endereco, cidade, cep, metodo_pagamento, status) 
              VALUES (?, ?, ?, ?, ?, 'pendente')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issss", $usuario_id, $endereco, $cidade, $cep, $pagamento);

    if ($stmt->execute()) {
        // Obter o ID do pedido recém-criado
        $pedido_id = $stmt->insert_id;

        // Inserir os detalhes do pedido (produtos, quantidades, preços)
        $query = "SELECT cp.produto_id, cp.quantidade, p.preco 
                  FROM carrinho_produtos cp 
                  JOIN produtos p ON cp.produto_id = p.id 
                  WHERE cp.carrinho_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $carrinho_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $produto_id = $row['produto_id'];
            $quantidade = $row['quantidade'];
            $preco_unitario = $row['preco'];
            $total_produto = $quantidade * $preco_unitario;

            // Inserir o produto na tabela 'pedidos_produtos'
            $query = "INSERT INTO pedidos_produtos (pedido_id, produto_id, quantidade, preco_unitario, total_produto) 
                      VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iiidd", $pedido_id, $produto_id, $quantidade, $preco_unitario, $total_produto);
            $stmt->execute();
        }

        // Atualizar o carrinho para "finalizado"
        $query = "UPDATE carrinho SET status = 'finalizado' WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $carrinho_id);
        $stmt->execute();

        echo "<p>Compra finalizada com sucesso! Seu pedido está em processo de pagamento, você sera redirecionado em 5 segundos.</p>";

        // Redirecionamento após 6 segundos
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'index.php'; // Redireciona para a página inicial
                }, 6000); // 6000ms = 6 segundos
              </script>";
    } else {
        echo "Erro ao processar a compra: " . $conn->error;
    }
} else {
    echo "<p>Carrinho não encontrado ou já finalizado.</p>";
}
?>
