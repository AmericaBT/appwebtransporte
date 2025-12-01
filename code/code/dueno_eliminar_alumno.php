<?php
include 'conexion.php';

$id = $_GET['id'];

$conexion->query("DELETE FROM alumnos WHERE id_alumno = $id");
$conexion->query("SET @num := 0");
$conexion->query("UPDATE alumnos SET id_alumno = (@num := @num + 1)");
$conexion->query("ALTER TABLE alumnos AUTO_INCREMENT = 1");

header("Location: indexdueno.php");
exit();
