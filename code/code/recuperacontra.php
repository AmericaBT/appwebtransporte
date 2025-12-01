<?php
// Lista fija de correos válidos y sus contraseñas reales
$usuarios_validos = [
    "americapb7u7@gmail.com" => ["password" => "chofer123", "rol" => "chofer"],
    "dueno@gmail.com"  => ["password" => "dueno123",  "rol" => "dueno"],
    "admin@gmail.com"  => ["password" => "admin123",  "rol" => "admin"]
];

// Obtener correo desde recuperarcontra.html
$correo = $_GET['correo'] ?? "";

if (!array_key_exists($correo, $usuarios_validos)) {
    echo "<script>
            alert('El correo no es válido');
            window.location.href='recuperarcontra.html';
          </script>";
    exit();
}

// Obtenemos los datos del rol
$password = $usuarios_validos[$correo]["password"];
$rol = $usuarios_validos[$correo]["rol"];

// Construimos el mensaje del correo
$asunto = "Recuperación de contraseña";
$mensaje = "Hola, tu rol es: $rol.\nTu contraseña es: $password";
$headers = "From: noreply@tuservidor.com";

// Enviar el correo
mail($correo, $asunto, $mensaje, $headers);

// Redirigir a vista de contraseña establecida
header("Location: contraseñaestablecida.html");
exit();
?>
