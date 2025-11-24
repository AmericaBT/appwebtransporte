<?php
session_start();
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    // Prevenir errores por caracteres raros
    $usuario = mysqli_real_escape_string($conexion, $usuario);
    $password = mysqli_real_escape_string($conexion, $password);

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['rol'] = $fila['rol'];

        // Redirigir según el rol
        if ($fila['rol'] === 'chofer') {
            header("Location: indexchoferes.php");
        } else if ($fila['rol'] === 'dueno') {
            header("Location: indexdueno.php");
        } else if ($fila['rol'] === 'admin') {
            header("Location: indexadmin.php");
        } else {
            echo "Rol no reconocido.";
        }
        exit();

    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='login.html';</script>";
    }
}
?>
