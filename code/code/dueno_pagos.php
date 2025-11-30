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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/styleglobals.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="css/stylepagosdueno.css?v=<?php echo time(); ?>" />
</head>

<body>
    <div class="duenos_pagos">

        <!-- Botones laterales -->
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

        <!-- Tabla -->
        <div class="table">
            <div class="group-table">

                <!-- Encabezado -->
                <div class="encabezado-table">
                    <div>Id_pagos</div>
                    <div>Nombre</div>
                    <div>Apellidos</div>
                    <div>Ingreso</div>
                    <div>Estado</div>
                    <div>Acciones</div>
                </div>

                <!-- Contenido dinámico -->
                <?php
                $contador = 1;
                while ($fila = $resultado->fetch_assoc()) {
                    if ($contador > 7) break;
                ?>
                    <div class="row">
                        <div><?php echo $fila['id_pago']; ?></div>
                        <div><?php echo htmlspecialchars($fila['nombre']); ?></div>
                        <div><?php echo htmlspecialchars($fila['apellidos']); ?></div>
                        <div>$<?php echo number_format($fila['ingreso'], 2); ?></div>

                        <div>
                            <?php 
                                if ($fila['estado'] == "Pendiente") echo "<span class='estado-pendiente'>Pendiente</span>";
                                if ($fila['estado'] == "Aprobado") echo "<span class='estado-aprobado'>Aprobado</span>";
                                if ($fila['estado'] == "Denegado") echo "<span class='estado-denegado'>Denegado</span>";
                            ?>
                        </div>

                        <div>
                            <?php if ($fila['estado'] == "Pendiente") { ?>
                                
                                <!-- Botón VALIDAR -->
                                <a href="validar_pago.php?id=<?php echo $fila['id_pago']; ?>">
                                    <button class="btn-aprobado">Aprobado</button>
                                </a>

                                <!-- Botón DENEGAR -->
                                <a href="denegar_pago.php?id=<?php echo $fila['id_pago']; ?>">
                                    <button class="btn-denegado">Denegado</button>
                                </a>

                            <?php } else { ?>
                                <span>—</span>
                            <?php } ?>
                        </div>
                    </div>
                <?php
                    $contador++;
                }
                ?>

                <?php if ($resultado->num_rows == 0) { ?>
                    <div class="sin-datos">No hay pagos registrados.</div>
                <?php } ?>

            </div>
        </div>

        <div class="seccion-name">Pagos</div>

        <!-- Banner superior -->
        <div class="top">
            <div class="banner"></div>
            <button class="Salir" onclick="window.location.href='login.html'">
                <img class="iconapp" src="icons/iconapp.svg" />
                <div class="title-app">TRANSPORTE ESCOLAR</div>
            </button>
        </div>

        <!-- ELIMINADO EL BOTÓN DE AGREGAR -->
    </div>
</body>
</html>
