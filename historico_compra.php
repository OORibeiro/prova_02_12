<?php
session_start();
include('conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Buscar os pedidos do usuário
$query = "SELECT * FROM pedidos WHERE usuario_id = ? ORDER BY data_pedido DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h2>Histórico de Compras</h2>";
    while ($row = $result->fetch_assoc()) {
        $pedido_id = $row['id'];
        $data_pedido = $row['data_pedido'];
        $status = $row['status'];

        echo "<h3>Pedido #$pedido_id - $status (Data: $data_pedido)</h3>";

        // Buscar os produtos deste pedido
        $query = "SELECT p.nome, pp.quantidade, pp.preco_unitario, pp.total_produto 
                  FROM pedidos_produtos pp
                  JOIN produtos p ON pp.produto_id = p.id
                  WHERE pp.pedido_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $pedido_id);
        $stmt->execute();
        $result_produtos = $stmt->get_result();

        if ($result_produtos->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Nome</th><th>Quantidade</th><th>Preço Unitário</th><th>Total</th></tr>";

            while ($produto = $result_produtos->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $produto['nome'] . "</td>";
                echo "<td>" . $produto['quantidade'] . "</td>";
                echo "<td>R$ " . number_format($produto['preco_unitario'], 2, ',', '.') . "</td>";
                echo "<td>R$ " . number_format($produto['total_produto'], 2, ',', '.') . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }

        // Detalhes do envio
        echo "<p><strong>Endereço de entrega:</strong> " . $row['endereco'] . ", " . $row['cidade'] . " - " . $row['cep'] . "</p>";
        echo "<p><strong>Método de pagamento:</strong> " . $row['metodo_pagamento'] . "</p>";
    }
} else {
    echo "<p>Você não tem nenhum pedido registrado.</p>";
}
?>
