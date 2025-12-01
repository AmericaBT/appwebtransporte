<?php
include('conexion.php');

$id = $_GET['id'];

$sql = "DELETE FROM alumnos WHERE id_alumno = $id";

if ($conexion->query($sql)) {
    header("Location: indexchoferes.php");
    exit();
} else {
    echo "Error al eliminar: " . $conexion->error;
}
?>
