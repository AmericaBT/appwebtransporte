<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

include 'conexion.php';

$id = $_GET['id'];
$query = "SELECT * FROM alumnos WHERE id_alumno = $id";
$res = $conexion->query($query);
$al = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styleglobals.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/stylechfagga.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="agg-alumnos-choferes">

    <div class="banner-seccion"></div>
    <button class="atras" onclick="window.location.href='indexdueno.php'">
        <img class="iconatras" src="icons/return.svg" />
        <div class="seccion-name">Editar Alumno</div>
    </button>

    <div class="group-banner-pag">
        <div class="banner"></div>
        <button class="Salir" onclick="window.location.href='login.html'">
            <img class="iconapp" src="icons/iconapp.svg" />
            <div class="title-app">TRANSPORTE ESCOLAR</div>
        </button>
    </div>

    <div class="group-formulario">
        <div class="borde"><div class="post"></div></div>

        <form action="dueno_update_alumno.php" method="POST">
            <input type="hidden" name="id" value="<?= $al['id_alumno'] ?>">

            <div class="group-nombre">
                <div class="name-campo-1">Nombre(s)</div>
                <input type="text" class="input-text-1" name="nombre" value="<?= $al['nombre'] ?>" required>
            </div>

            <div class="group-apellidop">
                <div class="name-campo-2">Apellido Paterno</div>
                <input type="text" class="input-text-2" name="apellido_paterno" value="<?= $al['apellido_paterno'] ?>" required>
            </div>

            <div class="group-apellidom">
                <div class="name-campo-3">Apellido Materno</div>
                <input type="text" class="input-text-3" name="apellido_materno" value="<?= $al['apellido_materno'] ?>" required>
            </div>

            <div class="group-escuela">
                <div class="name-campo-4">Escuela</div>
                <input type="text" class="input-text-4" name="escuela" value="<?= $al['escuela'] ?>" required>
            </div>

            <div class="group-escolaridad">
                <div class="name-campo-6">Escolaridad</div>
                <input type="text" class="input-text-6" name="escolaridad" value="<?= $al['escolaridad'] ?>">
            </div>

            <div class="group-turno">
                <div class="name-campo-5">Turno</div>

                <div class="interruptor">
                    <input type="radio" id="mat" name="turno" value="Matutino"
                        <?= $al['turno'] == 'Matutino' ? 'checked' : '' ?>>
                    <label for="mat" class="opcion-izquierda">Matutino</label>

                    <input type="radio" id="ves" name="turno" value="Vespertino"
                        <?= $al['turno'] == 'Vespertino' ? 'checked' : '' ?>>
                    <label for="ves" class="opcion-derecha">Vespertino</label>
                </div>
            </div>

            <div class="group-aggbtn">
                <button class="agregar1" type="submit">
                    <div class="button-name">Actualizar</div>
                    <img class="iconagg" src="icons/plus.svg" />
                </button>
            </div>

        </form>
    </div>

</div>

</body>
</html>
