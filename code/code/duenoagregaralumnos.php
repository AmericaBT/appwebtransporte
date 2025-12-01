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
    <link rel="stylesheet" href="css/stylechfagga.css?v=<?php echo time(); ?>" />
  </head>
  <body>
    <div class="agg-alumnos-choferes">

      <!--Banner amarillo de la seccion-->
      <div class="banner-seccion"></div>
      <button class="atras" onclick="window.location.href='indexdueno.php'">
        <img class="iconatras" src="icons/return.svg" />
        <div class="seccion-name">Agregar Alumnos</div>
      </button>

      <!--Banner del nombre de la pagina-->
      <div class="group-banner-pag">
        <div class="banner"></div>
        <button class="Salir" onclick="window.location.href='login.html'">
          <img class="iconapp" src="icons/iconapp.svg" />
          <div class="title-app">TRANSPORTE ESCOLAR</div>
        </button>
      </div>

      <!-- Cuadro donde se encuentra el formulario -->
      <div class="group-formulario">
        <div class="borde">
          <div class="post"></div>
        </div>
        <form action="insertar_alumnoduenos.php" method="POST">
    
          <div class="group-nombre">
            <div class="name-campo-1">Nombre(s)</div>
            <input type="text" class="input-text-1" name="nombre" placeholder="Ingrese nombre" required>
          </div>

          <div class="group-apellidop">
            <div class="name-campo-2">Apellido Paterno</div>
            <input type="text" class="input-text-2" name="apellido_paterno" placeholder="Ingrese apellido paterno" required>
          </div>

          <div class="group-apellidom">
            <div class="name-campo-3">Apellido Materno</div>
            <input type="text" class="input-text-3" name="apellido_materno" placeholder="Ingrese apellido materno" required>
          </div>

          <div class="group-escuela">
            <div class="name-campo-4">Escuela</div>
            <input type="text" class="input-text-4" name="escuela" placeholder="Ingrese escuela" required>
          </div>

          <div class="group-escolaridad">
            <div class="name-campo-6">Escolaridad</div>
            <input type="text" class="input-text-6" name="escolaridad" placeholder="Ingrese escolaridad">
          </div>

          <div class="group-turno">
          <div class="name-campo-5">Turno</div>
            <div class="interruptor">
              <input type="radio" id="matutino" name="turno" value="Matutino" checked>
              <label for="matutino" class="opcion-izquierda">Matutino</label>
              <input type="radio" id="vespertino" name="turno" value="Vespertino">
              <label for="vespertino" class="opcion-derecha">Vespertino</label>
            </div>
          </div>

          <div class="group-aggbtn">
            <button class="agregar1" type="submit" class="agregar">
              <div class="button-name">Agregar</div>
              <img class="iconagg" src="icons/plus.svg" />
            </button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
