<?php include('header.php'); ?>
<?php include('conexao.php'); ?>
<?php include('verifica_sessao.php'); ?>

<main>
    <h1>Cadastrar Novo Produto</h1>
    <form action="salvar_produto.php" method="POST" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea><br><br>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" required><br><br>

        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem" required><br><br>

        <label for="categoria">Categoria:</label>
    <select id="categoria" name="categoria" required>
        <option value="Categoria 1">Categoria 1</option>
        <option value="Categoria 2">Categoria 2</option>
        <option value="Categoria 3">Categoria 3</option>
    </select>

        <button type="submit">Cadastrar Produto</button>
    </form>
</main>

<?php include('footer.php'); ?>
