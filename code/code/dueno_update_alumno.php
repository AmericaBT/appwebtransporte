<?php
include 'conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$ap = $_POST['apellido_paterno'];
$am = $_POST['apellido_materno'];
$esc = $_POST['escuela'];
$escor = $_POST['escolaridad'];
$turno = $_POST['turno'];

$sql = "UPDATE alumnos SET 
        nombre='$nombre',
        apellido_paterno='$ap',
        apellido_materno='$am',
        escuela='$esc',
        escolaridad='$escor',
        turno='$turno'
        WHERE id_alumno = $id";

$conexion->query($sql);
header("Location: indexdueno.php");
exit();
