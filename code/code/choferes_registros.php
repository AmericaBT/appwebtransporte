<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

// Conexión a la base de datos
include __DIR__ . '/conexion.php';

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$query = "SELECT * FROM pagos ORDER BY id_pago ASC";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSS global + específico -->
    <link rel="stylesheet" href="css/styleglobals.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/styleregistros.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="choferes_pagos">

    <!-- BOTONES IZQUIERDA -->
    <div class="botones">

        <button class="alumnos" onclick="window.location.href='indexchoferes.php'">
            <img class="iconalum" src="icons/alumnos.svg" />
            <div class="iconalum-name">Alumnos</div>
        </button>

        <button class="pagos" onclick="window.location.href='choferes_pagos.php'">
            <div class="iconpag-name">Pagos</div>
            <img class="iconpag" src="icons/pagos.svg" />
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

    <!-- TABLA -->
    <div class="table">
        <div class="group-table">

            <div class="encabezado-table">
                <div>ID</div>
                <div>Nombre</div>
                <div>Apellidos</div>
                <div>Ingreso</div>
                <div>Estado</div>
                <div>Fecha</div>
            </div>

            <?php while ($fila = $resultado->fetch_assoc()) { ?>
              <div class="row">
                <div><?php echo $fila['id_pago']; ?></div>
                <div><?php echo htmlspecialchars($fila['nombre']); ?></div>
                <div><?php echo htmlspecialchars($fila['apellidos']); ?></div>
                <div>$<?php echo number_format($fila['ingreso'], 2); ?></div>
                <div><?php echo htmlspecialchars($fila['estado']); ?></div>
                <div><?php echo htmlspecialchars($fila['fecha_pago']); ?></div>
              </div>
            <?php } ?>

            <?php if ($resultado->num_rows == 0) { ?>
                <div class="sin-datos">No hay registros.</div>
            <?php } ?>

        </div>
    </div>

    <div class="seccion-name">Registros</div>

    <div class="top">
        <div class="banner"></div>
        <button class="Salir" onclick="window.location.href='login.html'">
            <img class="iconapp" src="icons/iconapp.svg" />
            <div class="title-app">TRANSPORTE ESCOLAR</div>
        </button>
    </div>

    <!-- BOTÓN IMPRIMIR (NUEVO) -->
    <div class="imprimir-botn">
        <button class="imprimir" onclick="window.location.href='reporte_semanal.php'">
            <div class="button-name">Imprimir</div>
        </button>
    </div>

</div>

</body>
</html>
