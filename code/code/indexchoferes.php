<?php
include __DIR__ . '/conexion.php';

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$query = "SELECT * FROM alumnos";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styleglobals.css" />
    <link rel="stylesheet" href="stylechoferes.css?v=1.7" />
    <title>Alumnos</title>
</head>
<body>
<div class="alumnos-chferes">

    <!--Seccion de botones-->
    <div class="botones">
        <button class="alumnos" onclick="window.location.href='indexchoferes.php'">
            <img class="iconalum" src="icons/alumnos.svg" />
            <div class="iconalum-name">Alumnos</div>
        </button>

        <button class="pagos" onclick="window.location.href='choferes_pagos.html'">
            <img class="iconpag" src="icons/pagos.svg" />
            <div class="iconpag-name">Pagos</div>
        </button>

        <button class="registros" onclick="window.location.href='choferes_registros.html'">
            <img class="iconreporte" src="icons/reportes.svg" />
            <img class="iconlibro" src="icons/libroreportes.svg" />
            <div class="iconlibro-name">Registros</div>
        </button>

        <button class="rutas" onclick="window.location.href='choferes_rutas.html'">
            <img class="iconrut" src="icons/rutas.svg" />
            <div class="iconrut-name">Rutas</div>
        </button>
    </div>

    <!--Seccion de la tabla-->
    <div class="table">
      <!-- Encabezado -->
      
      <div class="encabezado-table">
        <div>Id_alumno</div>
        <div>Nombre</div>
        <div>Apellidos</div>
        <div>Escuela</div>
        <div>Turno</div>
      </div>

      <!-- Filas dinámicas -->
      <?php while ($row = $resultado->fetch_assoc()): ?>
      <div class="row">
        <div><?php echo $row['id_alumno']; ?></div>
        <div><?php echo $row['nombre']; ?></div>
        <div><?php echo $row['apellido_paterno'] . ' ' . $row['apellido_materno']; ?></div>
        <div><?php echo $row['escuela']; ?></div>
        <div><?php echo $row['turno']; ?></div>
      </div>
      <?php endwhile; ?>
    </div>


    <!--Nombre de la seccion-->
    <div class="seccion-name">Alumnos</div>

    <!--Banner del nombre de la appweb-->
    <div class="top">
        <div class="banner"></div>
        <button class="Salir" onclick="window.location.href='login.html'">
            <img class="iconapp" src="icons/iconapp.svg" />
            <div class="title-app">TRANSPORTE ESCOLAR</div>
        </button>
    </div>

    <!--Boton de agregar-->
    <div class="agregar-botn">
        <button class="agregar" onclick="window.location.href='choferesagregaralumnos.php'">
            <div class="button-name">Agregar</div>
            <img class="iconagg" src="icons/plus.svg" />
        </button>
    </div>

</div>
</body>
</html>
