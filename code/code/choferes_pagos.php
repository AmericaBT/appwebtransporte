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
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/styleglobals.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="css/stylepagos.css?v=<?php echo time(); ?>" />
  </head>
  <body>
    <div class="choferes_pagos">
      <div class="botones">

       <!--BOTON ALUMNOS--> 
        <button class="alumnos" onclick="window.location.href='indexchoferes.php'">
          <img class="iconalum" src="icons/alumnos.svg" />
          <div class="iconalum-name">Alumnos</div>
        </button>

        <!--BOTON PAGOS--> 
        <button class="pagos" onclick="window.location.href='choferes_pagos.php'">
          <div class="iconpag-name">pagos</div>
          <img class="iconpag" src="icons/pagos.svg" />
        </button>

        <!--BOTON REGISTROS--> 
        <button class="registros" onclick="window.location.href='choferes_registros.php'">
          <img class="iconreporte" src="icons/reportes.svg" />
          <img class="iconlibro" src="icons/libroreportes.svg" />
          <div class="iconlibro-name">Registros</div>
        </button>

        <!--BOTON RUTAS--> 
        <button class="rutas" onclick="window.location.href='choferes_rutas.php'">
          <img class="iconrut" src="icons/rutas.svg" />
          <div class="iconrut-name">Rutas</div>
        </button>

      </div>
      <div class="table">

        <div class="group-table">

          <div class="last"></div>
          <div class="post"></div> 
          <!--Lineas de la tabla-->    

          <div class="linea-1"></div>
          <div class="linea-2"></div>
          <div class="linea-3"></div>
          <div class="linea-4"></div>
          <div class="linea-5"></div>
          <div class="linea-6"></div>
          <div class="linea-7"></div>

          <!--Encabezado de la tabla-->
          <div class="encabezado-table"></div>

          <!--contenido de la tabla por linea-->
          <div class="firsttext-line-1">1</div>
          <div class="firsttext-line-2">2</div>
          <div class="firsttext-line-3">3</div>
          <div class="firsttext-line-4">4</div>
          <div class="firsttext-line-5">5</div>
          <div class="firsttext-line-6">6</div>
          <div class="firsttext-line-7">7</div>

        </div>

        <div class="encabezado-1">Id_pagos</div>
        <div class="encabezado-2">Nombre</div>
        <div class="encabezado-3">Apellidos</div>
        <div class="encabezado-4">Ingreso</div>
        <div class="encabezado-5">Estado</div>

        <div class="text-2">Alyn Michel</div>
        <div class="text-3">Santiago Trinidad</div>
        <div class="text-5">Aprobado</div>
        <div class="text-4">$00.00</div>

      </div>

      <div class="seccion-name">Pagos</div>

      <div class="top">
        <div class="banner"></div>
        <img class="iconapp" src="icons/iconapp.svg" />
        <div class="title-app">TRANSPORTE ESCOLAR</div>
      </div>

      <div class="agregar-botn">
        <button class="agregar" onclick="window.location.href='choferesagregarpagos.html'">
          <div class="button-name">Agregar</div>
          <img class="iconagg" src="icons/plus.svg" />
        </button>
      </div>

    </div>
  </body>
</html>
