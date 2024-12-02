<?php include('header.php'); ?>

<main>
    <section id="contato">
        <h1>Contato</h1>
        <form action="enviar_contato.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="mensagem">Mensagem:</label><br>
            <textarea id="mensagem" name="mensagem" rows="5" required></textarea><br><br>

            <button type="submit">Enviar</button>
        </form>
    </section>
</main>

<?php include('footer.php'); ?>
