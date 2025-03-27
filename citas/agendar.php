<?php
include("conexion.php");
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #198754;
            padding: 15px;
            border-radius: 10px;
        }
        .dashboard-header img {
            height: 50px;
        }
        .btn-regresar {
            background-color: #ffc107;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            color: black;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-regresar:hover {
            background-color: #e0a800;
            color: black;
        }
        .form-container {
            margin-top: 20px;
        }
        .btn-primary {
            background-color: #198754;
            border: none;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #157347;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="dashboard-container">
        <div class="dashboard-header">
            <img src="img/logo_sena.png" alt="Logo SENA">
            <a href="dashboard.php" class="btn-regresar">Regresar</a>
        </div>
        <div class="form-container">
            <h3 class="text-center">Agendar Nueva Cita</h3>
            <form action="procesar_cita.php" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label"><strong>Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="servicio" class="form-label">Servicio</label>
                    <select class="form-select" id="servicio" name="servicio" required>
                        <option value="" selected disabled>Seleccione un servicio</option>
                        <option value="Médico General">Médico General</option>
                        <option value="Odontología">Odontología</option>
                        <option value="Dermatólogo">Dermatólogo</option>
                        <option value="Oftalmólogo">Oftalmólogo</option>
                        <option value="Otorrinolaringólogo">Otorrinolaringólogo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora</label>
                    <select class="form-select" id="hora" name="hora" required>
                        <option value="" selected disabled>Seleccione una hora</option>
                        <option value="08:00 AM">08:00 AM</option>
                        <option value="09:00 AM">09:00 AM</option>
                        <option value="10:00 AM">10:00 AM</option>
                        <option value="11:00 AM">11:00 AM</option>
                        <option value="12:00 PM">12:00 PM</option>
                        <option value="01:00 PM">01:00 PM</option>
                        <option value="02:00 PM">02:00 PM</option>
                        <option value="03:00 PM">03:00 PM</option>
                        <option value="04:00 PM">04:00 PM</option>
                        <option value="05:00 PM">05:00 PM</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Agendar Cita</button>
            </form>
        </div>
    </div>
</div>

<footer class="text-center mt-5">
    <p>Todos los derechos reservados © 2025 - Wilmer Niño Luna - Programa ADSO</p>
</footer>

</body>
</html>


