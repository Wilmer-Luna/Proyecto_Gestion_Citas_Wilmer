<?php
include("conexion.php");
session_start();

if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_rol"] !== "Administrador") {
    header("Location: login.php");
    exit();
}

$servicios = ["Médico General", "Odontología", "Dermatólogo", "Oftalmólogo", "Otorrinolaringólogo"];
$citas_por_servicio = [];

foreach ($servicios as $servicio) {
    $query = $conexion->prepare("SELECT nombre, fecha, hora FROM citas WHERE servicio = ? ORDER BY fecha ASC, hora ASC");
    $query->bind_param("s", $servicio);
    $query->execute();
    $resultado = $query->get_result();
    $citas_por_servicio[$servicio] = $resultado->fetch_all(MYSQLI_ASSOC);
    $query->close();
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #ECF0F1;
            color: #2C3E50;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #27AE60;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: white;
        }

        .dashboard-container {
            max-width: 1100px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: rgb(113, 192, 146);
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 500px;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            text-align: center;
            padding: 12px;
            vertical-align: middle;
        }

        th {
            background-color: #58D68D;
            color: white;
            font-size: 16px;
        }

        td {
            background-color: #F0F3F4;
            font-size: 15px;
        }

        tr:hover {
            background-color: #D5F5E3;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            margin: 0;
            padding: 15px;
            background-color: #58D68D;
            color: white;
            text-align: center;
            font-weight: bold;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        footer {
            margin-top: auto;
            background-color: #2C3E50;
            color: white;
            text-align: center;
            padding: 12px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="ms-3">
            <img src="img/logo_sena.png" alt="Logo SENA" width="60" height="60">
        </div>
        <div class="flex-grow-1 text-start ps-5">
            <span class="fw-bold fs-4 text-white">Administrador</span>
        </div>
        <div class="me-3">
            <a href="logout.php" class="btn btn-danger btn-lg px-4">Cerrar sesión</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="fw-bold" style="color: black;">Citas Programadas</h2>
    <?php foreach ($citas_por_servicio as $servicio => $citas): ?>
        <div class="card p-4 mb-4">
            <h3> <?= htmlspecialchars($servicio) ?> </h3>
            <div class="table-container">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th style="width: 33%;">Nombre</th>
                            <th style="width: 33%;">Fecha</th>
                            <th style="width: 33%;">Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($citas)): ?>
                            <tr>
                                <td colspan="3">No hay citas programadas</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($citas as $cita): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cita["nombre"]) ?></td>
                                    <td><?= htmlspecialchars($cita["fecha"]) ?></td>
                                    <td><?= date("g:i A", strtotime($cita["hora"])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<footer class="text-center">
    <p>Todos los derechos reservados © 2025 - Wilmer Niño Luna - Programa ADSO</p>
</footer>

</body>
</html>

