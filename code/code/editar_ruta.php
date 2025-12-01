<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

include __DIR__ . '/conexion.php';

$id = $_GET['id'];
$sql = "SELECT * FROM rutas WHERE id_ruta = $id";
$resultado = $conexion->query($sql);
$ruta = $resultado->fetch_assoc();
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

    <div class="banner-seccion"></div>

    <div class="group-banner-pag">
        <div class="banner"></div>
        <img class="iconapp" src="icons/iconapp.svg" />
        <div class="title-app">TRANSPORTE ESCOLAR</div>
    </div>

    <img class="iconatras" src="icons/return.svg" onclick="window.location.href='dueno_rutas.php'">
    <div class="seccion-name">Editar Ruta</div>

    <form action="update_ruta.php" method="POST">
        <input type="hidden" name="id_ruta" value="<?= $ruta['id_ruta'] ?>">

        <div class="group-formulario">
            <div class="borde">
                <div class="post">

                    <div class="group-nombre">
                        <label class="name-campo-1">Nombre de la Ruta</label>
                        <input type="text" name="nombre_ruta" value="<?= $ruta['nombre_ruta'] ?>" required>
                    </div>

                    <div class="group-apellidop">
                        <label class="name-campo-2">Descripción</label>
                        <input type="text" name="descripcion" value="<?= $ruta['descripcion'] ?>" required>
                    </div>

                    <div class="group-apellidom">
                        <label class="name-campo-3">Horario</label>
                        <input type="text" name="horario" value="<?= $ruta['horario'] ?>" required>
                    </div>

                    <div class="group-escuela">
                        <label class="name-campo-4">Chofer asignado</label>
                        <input type="text" name="chofer_asignado" value="<?= $ruta['chofer_asignado'] ?>" required>
                    </div>

                </div>
            </div>
        </div>

        <div class="group-aggbtn">
            <button class="agregar1" type="submit">
                <div class="button-name">Guardar</div>
                <img class="iconagg" src="icons/plus.svg" />
            </button>
        </div>

    </form>

</div>

</body>
</html>
