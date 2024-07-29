<?php
include 'conexion.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../login.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
