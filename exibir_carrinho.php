<?php
session_start();
include('conexao.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Buscar carrinho 'ativo' do usuário
$query = "SELECT * FROM carrinho WHERE usuario_id = ? AND status = 'ativo'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $carrinho = $result->fetch_assoc();
    $carrinho_id = $carrinho['id'];

    // Buscar os produtos associados ao carrinho
    $query = "SELECT p.id AS produto_id, p.nome, p.descricao, p.preco, cp.quantidade 
              FROM carrinho_produtos cp 
              JOIN produtos p ON cp.produto_id = p.id 
              WHERE cp.carrinho_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $carrinho_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $totalCarrinho = 0; // Variável para armazenar o total do carrinho

    if ($result->num_rows > 0) {
        echo "<form action='editar_quantidade_carrinho.php' method='POST'>";
        echo "<table>";
        echo "<tr><th>Nome</th><th>Descrição</th><th>Preço</th><th>Quantidade</th><th>Total</th><th>Ações</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $subtotal = $row['preco'] * $row['quantidade']; // Calcular o total de cada item
            $totalCarrinho += $subtotal; // Somar ao total do carrinho

            echo "<tr>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['descricao'] . "</td>";
            echo "<td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>";
            echo "<td><input type='number' name='quantidade[" . $row['produto_id'] . "]' value='" . $row['quantidade'] . "' min='1'></td>";
            echo "<td>R$ " . number_format($subtotal, 2, ',', '.') . "</td>";
            echo "<td><a href='remover_item_carrinho.php?id=" . $row['produto_id'] . "'>Remover</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        
        // Exibir o total do carrinho
        echo "<p><strong>Total do Carrinho: R$ " . number_format($totalCarrinho, 2, ',', '.') . "</strong></p>";

        // Adiciona um botão para atualizar as quantidades
        echo "<button type='submit' class='btn'>Atualizar Quantidades</button>";
        echo "</form>";
        echo "<a href='index.php'>Voltar</a><br><br>";
        // Mostrar o botão de "Finalizar Compra" apenas se houver produtos no carrinho
        echo "<a href='finalizar_compra.php' class='btn'>Finalizar Compra</a>";

    } else {
        echo "<p>Seu carrinho está vazio.</p>";
        echo "<a href='index.php'>Voltar</a>";
    }
} else {
    echo "<p>Seu carrinho está vazio.</p>";
}
?>
