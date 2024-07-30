<?php
$servername = "localhost";
$username = "gp6_gp6";
$password = "fKemLb5Svg";
$dbname = "gp6_trivia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

