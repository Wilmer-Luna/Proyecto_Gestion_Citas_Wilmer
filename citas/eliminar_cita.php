<?php
include("conexion.php");
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $cita_id = $_GET["id"];
    $usuario_id = $_SESSION["usuario_id"];

    $stmt = $conexion->prepare("DELETE FROM citas WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ii", $cita_id, $usuario_id);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error al eliminar la cita.";
    }
}
?>
