<?php
include('conexao.php');
include('verifica_sessao.php'); 
// colocar css nessa pagina
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM produtos WHERE id = $id");
    $produto = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    
    if ($_FILES['imagem']['name']) {
        // Se a imagem for alterada, faz o upload novamente
        $imagem = $_FILES['imagem']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($imagem);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file);
    } else {
        // Caso a imagem não tenha sido alterada, mantemos a imagem anterior
        $imagem = $produto['imagem'];
    }

    // Atualizar no banco de dados
    $sql = "UPDATE produtos SET nome = '$nome', descricao = '$descricao', preco = '$preco', 
            imagem = '$imagem', categoria = '$categoria' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Produto atualizado com sucesso!";
        header("Location: index.php");
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<main>
    <h1>Editar Produto</h1>
    <form action="editar_produto.php?id=<?php echo $produto['id']; ?>" method="POST" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $produto['nome']; ?>" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required><?php echo $produto['descricao']; ?></textarea><br><br>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" value="<?php echo $produto['preco']; ?>" required><br><br>

        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem"><br><br>

        <label for="categoria">Categoria:</label>
        <input type="text" id="categoria" name="categoria" value="<?php echo $produto['categoria']; ?>" required><br><br>

        <button type="submit">Atualizar Produto</button>
    </form>
</main>
