<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styleglobals.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/styleaggrutas.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="agg-ruta">

    <!-- LINEA AMARILLA -->
    <div class="banner-seccion"></div>

    <!-- BANNER SUPERIOR -->
    <div class="group-banner-pag">
        <div class="banner"></div>
        <img class="iconapp" src="icons/iconapp.svg" />
        <div class="title-app">TRANSPORTE ESCOLAR</div>
    </div>

    <!-- BOTÓN ATRÁS -->
    <img
        class="iconatras"
        src="icons/return.svg"
        onclick="window.location.href='dueno_rutas.php'"
    />

    <div class="seccion-name">Agregar Ruta</div>

    <!-- FORMULARIO -->
    <form action="insertar_ruta.php" method="POST">
        <div class="group-formulario">
            <div class="borde">
                <div class="post">

                    <!-- NOMBRE DE LA RUTA -->
                    <div class="group-nombre">
                        <label class="name-campo-1">Nombre de la Ruta</label>
                        <input type="text" name="nombre_ruta" required>
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="group-apellidop">
                        <label class="name-campo-2">Descripción</label>
                        <input type="text" name="descripcion" required>
                    </div>

                    <!-- HORARIO -->
                    <div class="group-apellidom">
                        <label class="name-campo-3">Horario</label>
                        <input type="text" name="horario" required>
                    </div>

                    <!-- CHOFER ASIGNADO -->
                    <div class="group-escuela">
                        <label class="name-campo-4">Chofer asignado</label>
                        <input type="text" name="chofer_asignado" required>
                    </div>

                </div>
            </div>
        </div>

        <!-- BOTÓN AGREGAR -->
        <div class="group-aggbtn">
            <button class="agregar" type="submit">
                <div class="agregar1">
                    <div class="button-name">Agregar</div>
                    <img class="iconagg" src="icons/plus.svg" />
                </div>
            </button>
        </div>

    </form>

</div>

</body>
</html>
