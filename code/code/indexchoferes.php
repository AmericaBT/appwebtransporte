<?php
session_start();

//verifica si el usuario ha iniciado sesion
if (!isset($_SESSION['usuario'])) {
    //si no hay sesion, redirigir al login
    header("Location: login.html");
    exit();
}

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
    <link rel="stylesheet" href="css/styleglobals.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="css/stylechoferes.css?v=<?php echo time(); ?>" />
    <title>Alumnos</title>

<style>
/* Contenedor con scroll vertical y horizontal */
.alumnos-chferes .table,
.alumnos-duenos .table {
  max-height: 430px;
  overflow-y: auto;
  overflow-x: auto;
  border-radius: 10px;
  position: relative;
}

/* Encabezado sticky funcionando correctamente */
.alumnos-chferes .table .encabezado-table,
.alumnos-duenos .table .encabezado-table {
  position: sticky !important;
  top: 0 !important;
  z-index: 10 !important;
  background: #f7ce58;
  display: flex;
  border-bottom: 2px solid #d4b040;
}

/* Filas */
.alumnos-chferes .table .row,
.alumnos-duenos .table .row {
  display: flex;
  width: 100%;
  box-sizing: border-box;
}
/* Columnas */
.alumnos-chferes .encabezado-table > div,
.alumnos-chferes .table .row > div,
.alumnos-duenos .encabezado-table > div,
.alumnos-duenos .table .row > div {
  flex: 1;
  min-width: 100px;
  padding: 7px;
  text-align: center;
  box-sizing: border-box;
}

/* Columna acciones más angosta */
.table .acciones {
  flex: 0 0 150px !important;
}

/* Estética buscador 
#filtroInput {
  width: calc(100% - 100px);
  max-width: 820px;
  padding: 8px;
  margin: 12px auto 10px auto;
  display: block;
  border-radius: 10px;
  border: 1px solid #999;
  font-size: 15px;
}*/

.buscador-contenedor {
    width: 110%;
    display: flex;
    justify-content: center;
    margin-top: -275px; /* 🔥 Ajusta esta altura según dónde lo quieras */
    margin-bottom: 10px;
}

.buscador-contenedor input {
    width: 60%;
    max-width: 700px;
    padding: 10px 14px;
    font-size: 17px;
    border-radius: 12px;
    border: 2px solid #888;
    outline: none;
}


</style>


</head>
<body>
<div class="alumnos-chferes">

    <!--Seccion de botones-->
    <div class="botones">
        <button class="alumnos" onclick="window.location.href='indexchoferes.php'">
            <img class="iconalum" src="icons/alumnos.svg" />
            <div class="iconalum-name">Alumnos</div>
        </button>

        <button class="pagos" onclick="window.location.href='choferes_pagos.php'">
            <img class="iconpag" src="icons/pagos.svg" />
            <div class="iconpag-name">Pagos</div>
        </button>

        <button class="registros" onclick="window.location.href='choferes_registros.php'">
            <img class="iconreporte" src="icons/reportes.svg" />
            <img class="iconlibro" src="icons/libroreportes.svg" />
            <div class="iconlibro-name">Registros</div>
        </button>

        <button class="rutas" onclick="window.location.href='choferes_rutas.php'">
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
        <div>Acciones</div>
      </div>

      <!-- Filas dinámicas -->
      <?php while ($row = $resultado->fetch_assoc()): ?>
      <div class="row">
        <div><?php echo $row['id_alumno']; ?></div>
        <div><?php echo $row['nombre']; ?></div>
        <div><?php echo $row['apellido_paterno'] . ' ' . $row['apellido_materno']; ?></div>
        <div><?php echo $row['escuela']; ?></div>
        <div><?php echo $row['turno']; ?></div>

        <div class="acciones">
            <button class="btn-editar"
                onclick="window.location.href='editar_alumno.php?id=<?php echo $row['id_alumno']; ?>'">
                ✏️ Editar
            </button>

            <button class="btn-eliminar"
                onclick="if(confirm('¿Eliminar este alumno?')) window.location.href='eliminar_alumno.php?id=<?php echo $row['id_alumno']; ?>'">
                🗑️ Eliminar
            </button>

        </div>
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

    <!-- 🔎 FILTRO DE BÚSQUEDA – ahora sí debajo del banner -->
    <div class="buscador-contenedor">
        <input type="text" id="filtroInput" placeholder="Buscar alumno...">
    </div>
    <!--Boton de agregar-->
    <div class="agregar-botn">
        <button class="agregar" onclick="window.location.href='choferesagregaralumnos.php'">
            <div class="button-name">Agregar</div>
            <img class="iconagg" src="icons/plus.svg" />
        </button>
    </div>

</div>

<script>
document.getElementById("filtroInput").addEventListener("input", function () {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll(".table .row");

    filas.forEach(fila => {
        const texto = fila.innerText.toLowerCase();
        fila.style.display = texto.includes(filtro) ? "" : "none";
    });
});
</script>



</body>
</html>
