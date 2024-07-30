<?php
include 'conexion.php';
session_start();

$usuario = $_SESSION['username'];

$sql = "SELECT id FROM usuarios WHERE username='$usuario'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $usuario_id = $row['id'];

    $sql = "SELECT pregunta_id, respuesta, es_correcta, imagen FROM respuestas WHERE usuario_id='$usuario_id'";
    $result = $conn->query($sql);

    $respuestas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $respuestas[] = $row;
        }
    }
    echo json_encode($respuestas);
} else {
    echo json_encode(['error' => 'Usuario no encontrado.']);
}
?>
