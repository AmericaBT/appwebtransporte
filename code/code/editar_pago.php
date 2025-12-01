<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

include __DIR__ . '/conexion.php';

if (!isset($_GET['id'])) {
    echo "ID no recibido";
    exit();
}

$id = intval($_GET['id']);
$consulta = $conexion->query("SELECT * FROM pagos WHERE id_pago = $id");

if ($consulta->num_rows == 0) {
    echo "Pago no encontrado";
    exit();
}

$fila = $consulta->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $ingreso = $_POST['ingreso'];

    $sql = "UPDATE pagos SET nombre='$nombre', apellidos='$apellidos', ingreso='$ingreso'
            WHERE id_pago=$id";

    if ($conexion->query($sql)) {
        header("Location: choferes_pagos.php?msg=editado");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/stylechfaggp.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="agg-alumnos-choferes">

    <div class="banner-seccion"></div>

    <button class="atras" onclick="window.location.href='choferes_pagos.php'">
        <img class="iconatras" src="icons/return.svg" />
        <div class="seccion-name">Editar Pago</div>
    </button>

          <!--Banner del nombre de la pagina-->
    <div class="group-banner-pag">
        <div class="banner"></div>
        <button class="Salir" onclick="window.location.href='login.html'">
            <img class="iconapp" src="icons/iconapp.svg" />
            <div class="title-app">TRANSPORTE ESCOLAR</div>
        </button>
    </div>

    <div class="group-formulario">
        <div class="borde"><div class="post"></div></div>
    </div>

    <form method="POST">

        <div class="group-nombre">
            <div class="name-campo-1">Nombre(s)</div>
            <input type="text" name="nombre" class="input-text-1" value="<?= $fila['nombre'] ?>" required>
        </div>

        <div class="group-apellidop">
            <div class="name-campo-2">Apellidos</div>
            <input type="text" name="apellidos" class="input-text-2" value="<?= $fila['apellidos'] ?>" required>
        </div>

        <div class="group-escuela">
            <div class="name-campo-4">Monto</div>
            <input type="number" name="ingreso" class="input-text-4" value="<?= $fila['ingreso'] ?>" required>
        </div>

        <div class="group-aggbtn">
            <div class="agregar1">
                <button type="submit" class="agregar">
                    <div class="button-name">Guardar</div>
                    <img class="iconagg" src="icons/plus.svg" />
                </button>
            </div>
        </div>

    </form>

</div>

</body>
</html>
