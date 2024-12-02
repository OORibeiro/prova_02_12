<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Página</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();
?>
<header>
    <nav>
        <ul>
           
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <li><a href="editar_usuario.php">Minha Conta</a></li>
                <li><a href="logout.php">Sair</a></li>
                <li><a href="exibir_carrinho.php">carrinho</a></li>
                <li><a href="historico_compra.php">Historico de Compras</a></li>
            <?php else: ?>
                <li><a href="login.php">Entrar</a></li>
                <li><a href="cadastro_usuario.php">Cadastrar</a></li>
                
            <?php endif; ?>
        </ul>
    </nav>
</header>




    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="sobre.php">Sobre Nós</a></li>
                <li><a href="produtos.php">Produtos/Serviços</a></li>
                <li><a href="contato.php">Contato</a></li>
               

            </ul>
        </nav>
    </header>

</body>
</html>