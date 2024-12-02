<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $endereco = $_POST['endereco'];

    // Verificar se todos os campos obrigatórios estão preenchidos
    if (empty($nome) || empty($email) || empty($senha) || empty($endereco)) {
        echo "Todos os campos são obrigatórios.";
        exit();
    }

    // Verificar se o e-mail já está cadastrado
    $query = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Erro no preparo da consulta: ' . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Este e-mail já está cadastrado. Tente outro.";
    } else {
        // Criptografar a senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Definir tipo_usuario como 'usuario' por padrão
        $tipo_usuario = 'usuario';  // Pode ser 'usuario' ou 'admin', dependendo de como você controla isso
        
        // Inserir no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha, endereco, tipo_usuario) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Erro no preparo da consulta de inserção: ' . $conn->error);
        }
        $stmt->bind_param("sssss", $nome, $email, $senha_hash, $endereco, $tipo_usuario);

        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
            header("Location: index.php"); // Redirecionar para a página de login após o cadastro
            exit(); // Garantir que o redirecionamento seja imediato
        } else {
            echo "Erro ao cadastrar o usuário: " . $conn->error;
        }
    }
}
?>