<?php
include('conexion.php'); // tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $escuela = $_POST['escuela'];
    $escolaridad = $_POST['escolaridad'];
    $turno = $_POST['turno'];

    $sql = "INSERT INTO alumnos (nombre, apellido_paterno, apellido_materno, escuela, escolaridad, turno) 
            VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$escuela', '$escolaridad', '$turno')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: indexdueno.php");
        exit();
    } else {
        echo "Error: " . $conexion->error;
    }

    $conexion->close();
}
?>
