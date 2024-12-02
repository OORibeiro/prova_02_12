

<?php include('header.php'); ?>
<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consultar o banco de dados
    $query = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Inicia a sessão e salva os dados do usuário
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_email'] = $usuario['email'];

        // Redireciona para a página solicitada ou para o index
        $destino = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
        header("Location: $destino");
        exit();
    } else {
        echo "E-mail ou senha inválidos!";
    }
}
?>
<form action="login.php<?php echo isset($_GET['redirect']) ? '?redirect=' . $_GET['redirect'] : ''; ?>" method="POST">
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>
    <button type="submit">Entrar</button>
</form>
<?php include('footer.php'); ?>