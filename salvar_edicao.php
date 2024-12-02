

<?php
session_start();
include('conexao.php');
include('verifica_sessao.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];

    // Atualizar os dados no banco
    $query = "UPDATE usuarios SET nome = ?, email = ?, endereco = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $nome, $email, $endereco, $id);

    if ($stmt->execute()) {
        // Redirecionar para a página inicial após salvar
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar os dados: " . $conn->error;
    }
}
?>
