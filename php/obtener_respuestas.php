<?php
include 'conexion.php';
session_start();

$usuario = $_SESSION['username'];

// Obtener el id del usuario desde la base de datos
$sql = "SELECT id FROM usuarios WHERE username='$usuario'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $usuario_id = $row['id'];

    // Obtener las respuestas del usuario
    $sql = "SELECT pregunta_id, respuesta, es_correcta FROM respuestas WHERE usuario_id='$usuario_id'";
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
