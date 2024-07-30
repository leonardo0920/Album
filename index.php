<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-primary text-white text-center py-4">
        <h1>Bienvenido al Albun De Barajitas</h1>
        <nav class="nav justify-content-center">
            <a class="nav-link text-white" href="historia.php">Historia</a>
            <a class="nav-link text-white" href="geografia.php">Geografía</a>
            <a class="nav-link text-white" href="tecnologia.php">Tecnología</a>
            <?php if (isset($_SESSION['username'])): ?>
                <span class="nav-link">Bienvenido, <?php echo $_SESSION['username']; ?>!</span>
                <a class="nav-link text-white" href="php/logout.php">Cerrar Sesión</a>
            <?php else: ?>
                <a class="nav-link text-white" href="login.html">Login</a>
                <a class="nav-link text-white" href="registro.html">Registro</a>
            <?php endif; ?>
        </nav>
    </header>
    <main class="container my-5">
        <section class="intro text-center">
            <h2>¡Participa y gana barajitas coleccionables!</h2>
            <p>Responde las trivias de tus categorías favoritas y colecciona barajitas únicas.</p>
        </section>
    </main>
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Album Barajitas</p>
        <p>Leonardo Davila, Gianpaolo Infantino, Daniel Pirell</p>
    </footer>
    <script src="js/scripts.js"></script>
</body>
</html>
