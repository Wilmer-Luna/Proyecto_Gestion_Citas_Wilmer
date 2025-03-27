<?php
include("conexion.php");
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION["usuario_id"];
    $nombre = $_POST["nombre"];
    $servicio = $_POST["servicio"];
    $fecha = $_POST["fecha"];
    $hora = date("H:i:s", strtotime($_POST["hora"])); 

    $stmt = $conexion->prepare("INSERT INTO citas (usuario_id, nombre, servicio, fecha, hora) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $usuario_id, $nombre, $servicio, $fecha, $hora);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error al agendar la cita.";
    }
}

