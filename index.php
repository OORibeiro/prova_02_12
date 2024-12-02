<?php include('header.php'); ?>
<?php include('conexao.php'); ?>

<main>
    <h1>Lista de Produtos</h1>
    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Pesquisar produtos...">
        <select name="categoria">
            <option value="">Todas as Categorias</option>
            <option value="Categoria 1">Categoria 1</option>
            <option value="Categoria 2">Categoria 2</option>
            <option value="Categoria 3">Categoria 3</option>
        </select>
        <button type="submit">Pesquisar</button>
    </form>

    <a href="cadastro_produto.php">Cadastrar novo produto</a>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: login.php");
            exit();
        }

        $usuario_id = $_SESSION['usuario_id'];

        // Obter o tipo do usuário
        $query = "SELECT tipo_usuario FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $is_admin = ($usuario['tipo_usuario'] === 'admin');

        // Pesquisar e exibir produtos
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

        $query = "SELECT * FROM produtos WHERE nome LIKE '%$search%' ";
        if ($categoria) {
            $query .= "AND categoria = '$categoria' ";
        }
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['descricao'] . "</td>";
                echo "<td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>";
                echo "<td>" . $row['categoria'] . "</td>";
                echo "<td>
                    <form action='produto_carrinho.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='produto_id' value='" . $row['id'] . "'>
                        <input type='number' name='quantidade' value='1' min='1' required>
                        <button type='submit'>Adicionar ao Carrinho</button>
                    </form>";

                // Exibir as opções de editar e excluir apenas para administradores
                if ($is_admin) {
                    echo "<a href='editar_produto.php?id=" . $row['id'] . "'>Editar</a> | 
                          <a href='excluir_produto.php?id=" . $row['id'] . "'>Excluir</a>";
                }

                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum produto encontrado</td></tr>";
        }
        ?>
        </tbody>
    </table>
</main>

<?php include('footer.php'); ?>
