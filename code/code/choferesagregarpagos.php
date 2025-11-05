<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

// Conexión a la base de datos
include __DIR__ . '/conexion.php';

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido_paterno = $_POST['apellido_paterno'] ?? '';
    $apellido_materno = $_POST['apellido_materno'] ?? '';
    $monto = $_POST['monto'] ?? '';

    $apellidos = trim($apellido_paterno . ' ' . $apellido_materno);

    if (!empty($nombre) && !empty($apellidos) && !empty($monto)) {
        $stmt = $conexion->prepare("INSERT INTO pagos (nombre, apellidos, ingreso, estado) VALUES (?, ?, ?, 'Pendiente')");
        $stmt->bind_param("ssd", $nombre, $apellidos, $monto);
        
        if ($stmt->execute()) {
            header("Location: choferes_pagos.php");
            exit();
        } else {
            echo "<script>alert('Error al registrar el pago.');</script>";
        }
    } else {
        echo "<script>alert('Por favor, completa todos los campos.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/styleglobals.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="css/stylechfaggp.css?v=<?php echo time(); ?>" />
  </head>
  <body>
    <div class="agg-alumnos-choferes">

      <!--Banner amarillo de la seccion-->
      <div class="banner-seccion"></div>
      <button class="atras" onclick="window.location.href='choferes_pagos.php'">
        <img class="iconatras" src="icons/return.svg" />
        <div class="seccion-name">Agregar Pago</div>
      </button>

      <!--Banner del nombre de la pagina-->
      <div class="group-banner-pag">
        <div class="banner"></div>
        <button class="Salir" onclick="window.location.href='login.html'">
          <img class="iconapp" src="icons/iconapp.svg" />
          <div class="title-app">TRANSPORTE ESCOLAR</div>
        </button>
      </div>

      <!--Cuadro donde se encuentra el formulario-->
      <div class="group-formulario">
        <div class="borde">
          <div class="post"></div>
        </div>
      </div>

      <!--Formulario de registro-->
      <form method="POST" action="">
        <div class="group-nombre">
          <div class="name-campo-1">Nombre(s)</div>
          <input type="text" name="nombre" class="input-text-1" placeholder="Ingrese nombre" required>
        </div>

        <div class="group-apellidop">
          <div class="name-campo-2">Apellido Paterno</div>
          <input type="text" name="apellido_paterno" class="input-text-2" placeholder="Ingrese apellido paterno" required>
        </div>

        <div class="group-apellidom">
          <div class="name-campo-3">Apellido Materno</div>
          <input type="text" name="apellido_materno" class="input-text-3" placeholder="Ingrese apellido materno" required>
        </div>

        <div class="group-escuela">
          <div class="name-campo-4">Monto</div>
          <input type="number" name="monto" class="input-text-4" placeholder="Ingrese monto" required>
        </div>

        <div class="group-aggbtn">
          <div class="agregar1">
            <button type="submit" class="agregar">
              <div class="button-name">Agregar</div>
              <img class="iconagg" src="icons/plus.svg" />
            </button>
          </div>
        </div>
      </form>

    </div>
  </body>
</html>
