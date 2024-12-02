<style>
/* Navbar */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #367599;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.logo a {
    font-size: 1.8rem;
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    text-transform: uppercase;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0;
    padding: 0;
}

.nav-links li {
    margin: 0;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-size: 1rem;
    font-weight: bold;
    padding: 10px 15px;
    transition: background-color 0.3s, color 0.3s;
}

.nav-links a:hover {
    background-color: #285779;
    border-radius: 5px;
}

/* User menu */
.user-menu {
    position: relative;
}

.user-icon img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
}

.dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 50px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    list-style: none;
    padding: 10px 0;
    z-index: 1000;
    min-width: 150px;
}

.dropdown-menu li {
    text-align: center;
    padding: 10px;
}

.dropdown-menu li a {
    text-decoration: none;
    color: #333;
    font-size: 1rem;
    display: block;
    transition: background-color 0.3s;
}

.dropdown-menu li a:hover {
    background-color: #f4f4f4;
}

/* Mostrar o menu dropdown ao passar o mouse */
.user-menu:hover .dropdown-menu {
    display: block;
}

form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

form input, form textarea, form button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form input:focus, form textarea:focus {
    border-color: #367599;
    outline: none;
    box-shadow: 0 0 5px rgba(54, 117, 153, 0.5);
}

form button {
    background-color: #367599;
    color: white;
    font-weight: bold;
    cursor: pointer;
    border: none;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #285779;
}

footer {
    background-color: #367599;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
}

main {
    padding: 20px;
}

h1, h2 {
    color: #333;
    text-align: center;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

.table th {
    background-color: #367599;
    color: white;
    font-weight: bold;
}

/* Estilo da página Contato */
#contato {
    text-align: center;
    margin: 20px;
}

#contato form {
    max-width: 500px;
    margin: 0 auto;
}

#contato form input, #contato form textarea {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

/* Seção Sobre Nós */
#sobre {
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
}

.sobre-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: center;
    margin-bottom: 40px;
}

.sobre-texto {
    flex: 1 1 50%;
    line-height: 1.8;
    color: #333;
    text-align: left;
}

.sobre-texto h1 {
    font-size: 2.5rem;
    color: #367599;
    margin-bottom: 20px;
}

.sobre-imagem {
    flex: 1 1 40%;
}

.sobre-imagem img {
    max-width: 100%;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Valores */
.valores {
    text-align: center;
}

.valores h2 {
    font-size: 2rem;
    color: #367599;
    margin-bottom: 20px;
}

.valores-cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.valor-card {
    background-color: #f4f4f4;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 20px;
    max-width: 300px;
    flex: 1 1 calc(33.333% - 40px);
}

.valor-card img {
    max-width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 5px;
    margin-bottom: 15px;
}

.valor-card h3 {
    color: #367599;
    margin-bottom: 10px;
}

.valor-card p {
    font-size: 1rem;
    line-height: 1.6;
}

/* Melhorias no layout geral */

#home .hero {
    background-image: url('loja3.webp');
    background-size: cover;
    background-position: center;
    color: #5bf3ff; 
    text-align: center;
    padding: 120px 20px;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    margin-bottom: 50px;
    filter: brightness(0.9);
}


#home .hero h1 {
    font-size: 3.5rem;
    margin-bottom: 25px;
    /* text-shadow: 0 3px 6px rgba(0, 0, 0, 0.8); */
    font-family: 'Poppins', sans-serif;
    color: #367599; 
}

#home .hero p {
    font-size: 1.3rem;
    margin-bottom: 35px;
    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.7);
    line-height: 1.5;
}

#home .hero .cta-button {
    display: inline-block;
    background-color: #367599;
    color: #ffffff;
    padding: 15px 40px;
    font-size: 1.2rem;
    font-weight: bold;
    text-transform: uppercase;
    border-radius: 8px;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: all 0.3s;
}

#home .hero .cta-button:hover {
    background-color: #285779;
    color: #ffffff;
}

/* Features Section */
#home .features {
    text-align: center;
    margin: 50px 0;
    padding: 20px;
    background-color: #f4f9ff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

#home .features h2 {
    font-size: 2.5rem;
    color: #367599;
    margin-bottom: 25px;
    font-family: 'Poppins', sans-serif;
}

#home .features-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 25px;
}

#home .features .feature {
    background-color: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 320px;
    transition: transform 0.3s, box-shadow 0.3s;
}

#home .features .feature:hover {
    transform: translateY(-8px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
}

#home .features .feature img {
    max-width: 100px;
    margin-bottom: 20px;
}

#home .features .feature h3 {
    font-size: 1.6rem;
    color: #367599;
    margin-bottom: 15px;
    font-family: 'Poppins', sans-serif;
}

#home .features .feature p {
    font-size: 1rem;
    color: #555555;
    line-height: 1.6;
}



</style><footer>
    <p>&copy; 2024 Otho e Kauã - Todos os direitos reservados</p>
</footer>
</body>
</html>
