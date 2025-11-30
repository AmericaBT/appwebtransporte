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

    <div class="agregar-botn">
        <button class="agregar" onclick="window.location.href='duenoagregarruta.php'">
            <div class="button-name">Agregar</div>
            <img class="iconagg" src="icons/plus.svg" />
        </button>
    </div>

</div>

</body>
</html>
