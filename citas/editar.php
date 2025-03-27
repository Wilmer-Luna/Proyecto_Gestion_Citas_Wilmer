<?php
include("conexion.php");
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("Error: ID de cita no proporcionado.");
}

$id = $_GET["id"];

$stmt = $conexion->prepare("SELECT * FROM citas WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $id, $_SESSION["usuario_id"]);
$stmt->execute();
$result = $stmt->get_result();
$cita = $result->fetch_assoc();

if (!$cita) {
    die("Error: Cita no encontrada o no tienes permiso para editarla.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $servicio = $_POST["servicio"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];

    $hora_convertida = date("H:i", strtotime($hora));

    $stmt = $conexion->prepare("UPDATE citas SET nombre = ?, servicio = ?, fecha = ?, hora = ? WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ssssii", $nombre, $servicio, $fecha, $hora_convertida, $id, $_SESSION["usuario_id"]);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
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
            <img src="img/logo_sena.png" alt="Logo del SENA"> 
            <a href="dashboard.php" class="btn-regresar">Regresar</a>
        </div>

        <h2 class="text-center" style="margin-top: 25px;">Editar Cita</h2>
        <form action="actualizar_cita.php" method="POST">
            <input type="hidden" name="id" value="<?= $cita['id'] ?>">

            <div class="mb-3">
                <label for="nombre" class="form-label"><strong>Nombre:</label>
                <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($cita['nombre']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="servicio" class="form-label">Servicio:</label>
                <select class="form-control" name="servicio" required>
                    <option value="Médico General" <?= ($cita['servicio'] == "Médico General") ? "selected" : "" ?>>Médico General</option>
                    <option value="Odontología" <?= ($cita['servicio'] == "Odontología") ? "selected" : "" ?>>Odontología</option>
                    <option value="Dermatólogo" <?= ($cita['servicio'] == "Dermatólogo") ? "selected" : "" ?>>Dermatólogo</option>
                    <option value="Oftalmólogo" <?= ($cita['servicio'] == "Oftalmólogo") ? "selected" : "" ?>>Oftalmólogo</option>
                    <option value="Otorrinolaringólogo" <?= ($cita['servicio'] == "Otorrinolaringólogo") ? "selected" : "" ?>>Otorrinolaringólogo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" name="fecha" value="<?= $cita['fecha'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="hora" class="form-label">Hora:</label>
                <select name="hora" id="hora" class="form-control" required>
                    <?php
                    $horas = [
                        "08:00 AM", "09:00 AM", "10:00 AM", "11:00 AM",
                        "12:00 PM", "01:00 PM", "02:00 PM", "03:00 PM",
                        "04:00 PM", "05:00 PM"
                    ];

                    $hora_original = date("h:i A", strtotime($cita["hora"]));

                    foreach ($horas as $hora) {
                        $selected = ($hora_original == $hora) ? "selected" : "";
                        echo "<option value='$hora' $selected>$hora</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100">Actualizar Cita</button>
        </form>
    </div>
</div>

<footer class="text-center mt-5">
    <p>Todos los derechos reservados © 2025 - Wilmer Niño Luna - Programa ADSO</p>
</footer>

</body>
</html>



