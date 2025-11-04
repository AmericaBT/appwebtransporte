<?php
session_start();

// Conexión con la base de datos
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta a la base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['rol'] = $fila['rol'];

        // Redirigir según el rol
        switch ($fila['rol']) {
            case 'chofer':
                header("Location: indexchoferes.php");
                break;
            case 'dueno':
                header("Location: indexdueno.php");
                break;
            case 'admin':
                header("Location: indexadmin.php");
                break;
            default:
                echo "Rol no reconocido.";
                break;
        }
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='login.html';</script>";
    }

    $conexion->close();
}
?>
