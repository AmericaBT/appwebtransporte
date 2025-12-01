<?php
session_start();
include __DIR__ . '/conexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM rutas WHERE id_ruta = $id";

if ($conexion->query($sql)) {
    header("Location: dueno_rutas.php");
    exit();
} else {
    echo "Error al eliminar: " . $conexion->error;
}

$conexion->close();
?>
