<?php
include __DIR__ . '/conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM pagos WHERE id_pago = $id";

    if ($conexion->query($sql)) {
        header("Location: choferes_pagos.php?msg=eliminado");
        exit();
    } else {
        echo "Error: " . $conexion->error;
    }
} else {
    echo "ID no recibido";
}
