<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

include __DIR__ . '/conexion.php';

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$ingreso = $_POST['ingreso'];
$estado = 'Pendiente';

$sql = "INSERT INTO pagos (nombre, apellidos, ingreso, estado)
        VALUES ('$nombre', '$apellidos', '$ingreso', '$estado')";

if (mysqli_query($conexion, $sql)) {
    header("Location: choferes_pagos.php");
    exit();
} else {
    echo "Error al registrar el pago: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
