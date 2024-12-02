<?php include('header.php'); ?>

<main>
    <section id="contato">
        <h1>Entre em Contato</h1>
        <p>Se você tiver dúvidas ou sugestões, preencha o formulário abaixo. Retornaremos o mais breve possível.</p>
        <form action="enviar_contato.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Seu e-mail" required>

            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="5" placeholder="Escreva sua mensagem aqui..." required></textarea>

            <button type="submit">Enviar Mensagem</button>
        </form>
    </section>
</main>

<?php include('footer.php'); ?>

