<?php
include('conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$escuela = $_POST['escuela'];
$escolaridad = $_POST['escolaridad'];
$turno = $_POST['turno'];

$sql = "UPDATE alumnos SET 
        nombre='$nombre',
        apellido_paterno='$apellido_paterno',
        apellido_materno='$apellido_materno',
        escuela='$escuela',
        escolaridad='$escolaridad',
        turno='$turno'
        WHERE id_alumno=$id";

if ($conexion->query($sql)) {
    header("Location: indexchoferes.php");
    exit();
} else {
    echo "Error: " . $conexion->error;
}
?>
