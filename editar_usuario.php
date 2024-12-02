<?php
session_start();
include('conexao.php');
include('verifica_sessao.php'); 
// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Obter as informações do usuário
$id = $_SESSION['usuario_id'];
$query = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
?>

<main>
    <h1>Editar Conta</h1>
    <form action="salvar_edicao.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required><br><br>

        <label for="endereco">Endereço:</label>
        <textarea id="endereco" name="endereco"><?php echo $usuario['endereco']; ?></textarea><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</main>
