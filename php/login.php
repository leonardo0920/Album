<?php
include 'conexion.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    session_start();
    $_SESSION['username'] = $username;
    header("Location: ../index.php");
} else {
    echo "Usuario o contraseña incorrectos.";
}
?>
