<?php
include __DIR__ . '/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cambiar estado a DENEGADO
    $sql = "UPDATE pagos SET estado = 'DENEGADO' WHERE id_pago = '$id'";

    if (mysqli_query($conexion, $sql)) {
        header("Location: dueno_pagos.php?msg=denegado");
        exit();
    } else {
        echo "Error al denegar el pago";
    }
} else {
    echo "ID no recibido";
}
?>
