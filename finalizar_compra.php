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

    // Verificar se o carrinho tem pelo menos 1 item
    $query = "SELECT COUNT(*) AS total_produtos FROM carrinho_produtos WHERE carrinho_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $carrinho_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['total_produtos'] > 0) {
        // Exibir formulário de dados de entrega e pagamento
        ?>
        <h2>Finalizar Compra</h2>
        <form action="processar_compra.php" method="POST">
            <h3>Dados de Entrega</h3>
            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" required><br>
            
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" required><br>
            
            <label for="cep">CEP:</label>
            <input type="text" name="cep" required><br>
            
            <h3>Forma de Pagamento</h3>
            <label for="pagamento">Escolha uma forma de pagamento:</label>
            <select name="pagamento" required>
                <option value="cartao_credito">Cartão de Crédito</option>
                <option value="boleto">Boleto</option>
            </select><br>
            
            <input type="submit" value="Finalizar Compra">
        </form>
        <?php
    } else {
        echo "<p>Seu carrinho está vazio. Não é possível finalizar a compra.</p>";
    }
} else {
    echo "<p>Carrinho não encontrado ou já finalizado.</p>";
}
?>
