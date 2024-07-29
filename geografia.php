<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia de Geografía</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>Bienvenido a las Trivias Coleccionables</h1>
        <nav>
            <a href="historia.php">Historia</a>
            <a href="geografia.php">Geografía</a>
            <a href="tecnologia.php">Tecnología</a>
            <?php if (isset($_SESSION['username'])): ?>
                <span>Bienvenido, <?php echo $_SESSION['username']; ?>!</span>
                <a href="php/logout.php">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.html">Login</a>
                <a href="registro.html">Registro</a>
            <?php endif; ?>
        </nav>
        <h2>Trivia de Geografía</h2>
    </header>
    <main>
        <div id="trivia-container" class="trivia-container">
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Trivias Coleccionables</p>
    </footer>
    <script src="js/scripts.js"></script>
</body>
</html>