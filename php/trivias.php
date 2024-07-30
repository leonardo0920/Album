<?php
include 'conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respuestas = json_decode(file_get_contents('php://input'), true);
    $pregunta_id = $respuestas['pregunta_id'];
    $respuesta = $respuestas['respuesta'];
    $imagen = $respuestas['imagen'];
    $usuario = $_SESSION['username'];

    $sql = "SELECT id FROM usuarios WHERE username='$usuario'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $usuario_id = $row['id'];

        $sql = "SELECT respuesta_correcta FROM trivias WHERE id='$pregunta_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $respuesta_correcta = $row['respuesta_correcta'];

            $es_correcta = ($respuesta === $respuesta_correcta) ? 1 : 0;

            if ($es_correcta) {
                $sql = "INSERT INTO respuestas (usuario_id, pregunta_id, respuesta, es_correcta, imagen) VALUES ('$usuario_id', '$pregunta_id', '$respuesta', '$es_correcta', '$imagen')";
                if ($conn->query($sql) === TRUE) {
                    echo json_encode(['correcta' => $es_correcta]);
                } else {
                    echo json_encode(['error' => 'Error al guardar la respuesta.']);
                }
            } else {
                echo json_encode(['correcta' => $es_correcta]);
            }
        } else {
            echo json_encode(['error' => 'Pregunta no encontrada.']);
        }
    } else {
        echo json_encode(['error' => 'Usuario no encontrado.']);
    }
}
?>
