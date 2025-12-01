<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

include __DIR__ . '/conexion.php';

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$query = "SELECT * FROM rutas ORDER BY id_ruta ASC";
$resultado = $conexion->query($query);

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/styleglobals.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="css/stylerutasdueno.css?v=<?php echo time(); ?>" />
<style>
/* Contenedor con scroll vertical y horizontal */
.duenos_rutas .table,
.duenos_rutas .table {
  max-height: 430px;
  overflow-y: auto;
  overflow-x: auto;
  border-radius: 10px;
  position: relative;
}

/* Encabezado sticky funcionando correctamente */
.duenos_rutas .table .encabezado-table,
.duenos_rutas .table .encabezado-table {
  position: sticky !important;
  top: 0 !important;
  z-index: 10 !important;
  background: #f7ce58;
  display: flex;
  border-bottom: 2px solid #d4b040;
}

/* Filas */
.duenos_rutas .table .row,
.duenos_rutas .table .row {
  display: flex;
  width: 100%;
  box-sizing: border-box;
}
/* Columnas */
.duenos_rutas .encabezado-table > div,
.duenos_rutas .table .row > div,
.duenos_rutas .encabezado-table > div,
.duenos_rutas .table .row > div {
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

<div class="duenos_rutas">

    <div class="botones">
        <button class="alumnos" onclick="window.location.href='indexdueno.php'">
            <img class="iconalum" src="icons/alumnos.svg" />
            <div class="iconalum-name">Alumnos</div>
        </button>

        <button class="pagos" onclick="window.location.href='dueno_pagos.php'">
            <div class="iconpag-name">Pagos</div>
            <img class="iconpag" src="icons/pagos.svg" />
        </button>

        <button class="rutas" onclick="window.location.href='dueno_rutas.php'">
            <img class="iconrut" src="icons/rutas.svg" />
            <div class="iconrut-name">Rutas</div>
        </button>
    </div>

    <div class="table">
        <div class="group-table">

            <div class="encabezado-table">
                <div>ID</div>
                <div>Nombre</div>
                <div>Descripción</div>
                <div>Horario</div>
                <div>Chofer</div>
                <div>Acciones</div>
            </div>

            <?php
            if ($resultado && $resultado->num_rows > 0) {
                $contador = 1;
                while ($fila = $resultado->fetch_assoc()) {
                    if ($contador > 7) break;
            ?>
                    <div class="row">
                        <div><?= $fila['id_ruta'] ?></div>
                        <div><?= htmlspecialchars($fila['nombre_ruta']) ?></div>
                        <div><?= htmlspecialchars($fila['descripcion']) ?></div>
                        <div><?= htmlspecialchars($fila['horario']) ?></div>
                        <div><?= htmlspecialchars($fila['chofer_asignado']) ?></div>

                        <!-- BOTONES EDITAR / ELIMINAR -->
                        <div class="acciones">
                            <button class="btn-editar" onclick="window.location.href='editar_ruta.php?id=<?= $fila['id_ruta'] ?>'">
                                ✏️ Editar
                            </button>

                            <button class="btn-eliminar" onclick="if(confirm('¿Eliminar esta ruta?')) window.location.href='eliminar_ruta.php?id=<?= $fila['id_ruta'] ?>'">
                                🗑️ Eliminar
                            </button>
                        </div>
                    </div>
            <?php
                    $contador++;
                }
            } else {
                echo "<div class='sin-datos'>No hay rutas registradas.</div>";
            }
            ?>

        </div>
    </div>

    <div class="seccion-name">Rutas</div>

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

    <div class="agregar-botn">
        <button class="agregar" onclick="window.location.href='duenoagregarruta.php'">
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
