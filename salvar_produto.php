<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pegando os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];

    // Lidar com a imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagem_nome = $_FILES['imagem']['name'];
        $imagem_tmp = $_FILES['imagem']['tmp_name'];
        $imagem_destino = "uploads/" . $imagem_nome;
        move_uploaded_file($imagem_tmp, $imagem_destino);  // Move a imagem para o diretório de uploads
    } else {
        $imagem_destino = ''; // Caso a imagem não seja fornecida
    }

    // Verificar se todos os campos obrigatórios foram preenchidos
    if (empty($nome) || empty($descricao) || empty($preco) || empty($categoria)) {
        echo "Todos os campos são obrigatórios!";
    } else {
        // Inserir o produto no banco de dados
        $query = "INSERT INTO produtos (nome, descricao, preco, imagem, categoria) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $nome, $descricao, $preco, $imagem_destino, $categoria);

        if ($stmt->execute()) {
            echo "Produto cadastrado com sucesso!";
            header("Location: index.php");  // Redireciona para a página principal
            exit();
        } else {
            echo "Erro ao cadastrar o produto: " . $conn->error;
        }
    }
}
?>
