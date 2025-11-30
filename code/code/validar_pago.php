<?php
include __DIR__ . '/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cambiar estado a VALIDADO
    $sql = "UPDATE pagos SET estado = 'APROBADO' WHERE id_pago = '$id'";

    if (mysqli_query($conexion, $sql)) {
        header("Location: dueno_pagos.php?msg=aprobado");
        exit();
    } else {
        echo "Error al aprobar el pago";
    }
} else {
    echo "ID no recibido";
}
?>
