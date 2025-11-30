<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

include __DIR__ . '/conexion.php';

$nombre = $_POST['nombre_ruta'];
$descripcion = $_POST['descripcion'];
$horario = $_POST['horario'];
$chofer = $_POST['chofer_asignado'];

$sql = "INSERT INTO rutas (nombre_ruta, descripcion, horario, chofer_asignado)
        VALUES ('$nombre', '$descripcion', '$horario', '$chofer')";

if (mysqli_query($conexion, $sql)) {
    header("Location: dueno_rutas.php");
    exit();
} else {
    echo "Error al insertar: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
