<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Loja</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Modal Container */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Modal Content */
        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .modal-header .close {
            cursor: pointer;
            font-size: 1.5rem;
            background: none;
            border: none;
        }

        .modal-body {
            margin-top: 20px;
        }

        .modal-body form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .modal-body form input {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .modal-body form button {
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .modal-body form button:hover {
            background-color: #0056b3;
        }

        .switch-link {
            margin-top: 10px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .highlight {
            color: #007BFF;
            font-weight: bold;
        }

        .highlight:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
session_start();
?>
<header>
    <nav class="navbar">
        <!-- Logo -->
        <div class="logo">
           
        </div>

        <!-- Links principais -->
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="sobre.php">Sobre Nós</a></li>
            <li><a href="produtos.php">Produtos</a></li>
            <li><a href="contato.php">Contato</a></li>
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

        <!-- Menu de perfil -->
        <div class="user-menu">
            <?php if (isset($_SESSION['usuario_id'])): ?>
              
                </a>
            <?php else: ?>
                <a href="#" class="user-icon" id="userIcon">
                    <img src="5087579.png" alt="">
                </a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<!-- Modal -->
<div class="modal" id="authModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Login</h2>
            <button class="close" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <!-- Login Form -->
            <form id="loginForm">
                <input type="text" placeholder="Email" required>
                <input type="password" placeholder="Senha" required>
                <button type="submit">Entrar</button>
            </form>

            <!-- Cadastro Form (Hidden by default) -->
            <form id="registerForm" style="display: none;">
                <input type="text" placeholder="Nome" required>
                <input type="email" placeholder="Email" required>
                <input type="password" placeholder="Senha" required>
                <button type="submit">Cadastrar</button>
            </form>

            <div class="switch-link" id="switchLink">
                <center><span class="highlight" id="toggleText">Não tem uma conta? Cadastre-se aqui.</span></center>
            </div>
        </div>
    </div>
</div>

<script>
    const userIcon = document.getElementById('userIcon');
    const authModal = document.getElementById('authModal');
    const closeModal = document.getElementById('closeModal');
    const switchLink = document.getElementById('switchLink');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const modalTitle = document.getElementById('modalTitle');
    const toggleText = document.getElementById('toggleText');

    // Open modal on user icon click
    userIcon.addEventListener('click', () => {
        authModal.style.display = 'flex';
    });

    // Close modal
    closeModal.addEventListener('click', () => {
        authModal.style.display = 'none';
    });

    // Switch between login and register
    switchLink.addEventListener('click', () => {
        if (loginForm.style.display === 'none') {
            loginForm.style.display = 'block';
            registerForm.style.display = 'none';
            modalTitle.textContent = 'Login';
            toggleText.textContent = 'Não tem uma conta? Cadastre-se aqui.';
        } else {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
            modalTitle.textContent = 'Cadastro';
            toggleText.textContent = 'Já tem uma conta? Faça login aqui.';
        }
    });

    // Close modal on outside click
    window.addEventListener('click', (e) => {
        if (e.target === authModal) {
            authModal.style.display = 'none';
        }
    });
</script>
</body>
</html>
