<?php
include 'conexion.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$categoria = $_GET['categoria'];

$sql = "SELECT id, pregunta, opciones, respuesta_correcta, imagen FROM trivias WHERE categoria = '$categoria'";
$result = $conn->query($sql);

$trivias = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $trivia = [
            'id' => $row['id'],
            'pregunta' => $row['pregunta'],
            'opciones' => explode(',', $row['opciones']),
            'respuesta_correcta' => $row['respuesta_correcta'],
            'imagen' => $row['imagen']
        ];
        array_push($trivias, $trivia);
    }
} else {
    $trivias = ['error' => 'No se encontraron trivias para esta categoría.'];
}

echo json_encode($trivias);

$conn->close();
?>
