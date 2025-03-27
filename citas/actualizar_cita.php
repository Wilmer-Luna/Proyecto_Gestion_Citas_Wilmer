<?php
include("conexion.php");
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $servicio = $_POST["servicio"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $usuario_id = $_SESSION["usuario_id"];

    $hora_convertida = date("H:i", strtotime($hora));

    $stmt = $conexion->prepare("UPDATE citas SET nombre = ?, servicio = ?, fecha = ?, hora = ? WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ssssii", $nombre, $servicio, $fecha, $hora_convertida, $id, $usuario_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error al actualizar la cita.";
    }
}
?>

