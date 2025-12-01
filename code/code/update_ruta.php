<?php
session_start();
include __DIR__ . '/conexion.php';

$id = $_POST['id_ruta'];
$nombre = $_POST['nombre_ruta'];
$descripcion = $_POST['descripcion'];
$horario = $_POST['horario'];
$chofer = $_POST['chofer_asignado'];

$sql = "UPDATE rutas 
        SET nombre_ruta='$nombre',
            descripcion='$descripcion',
            horario='$horario',
            chofer_asignado='$chofer'
        WHERE id_ruta = $id";

if ($conexion->query($sql)) {
    header("Location: dueno_rutas.php");
    exit();
} else {
    echo "Error al actualizar: " . $conexion->error;
}

$conexion->close();
?>
