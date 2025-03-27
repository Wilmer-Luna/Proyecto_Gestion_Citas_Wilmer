<?php
include("conexion.php");
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];

$query = $conexion->prepare("SELECT nombre FROM usuarios WHERE id = ?");
$query->bind_param("i", $usuario_id);
$query->execute();
$result = $query->get_result();
$usuario = $result->fetch_assoc()["nombre"] ?? "Usuario";

$resultado = $conexion->query("SELECT * FROM citas WHERE usuario_id = $usuario_id");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #F5F5F5;
            color: #000;
            min-height: 100vh; 
            display: flex;
            flex-direction: column; 
        }

        .navbar {
            background-color: #27AE60; 
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: white;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .dashboard-container {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #27AE60;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary, .btn-warning, .btn-danger {
            border-radius: 8px;
        }

        .logout-btn {
            background-color: #C0392B;
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background-color: #922B21;
        }

        footer {
            margin-top: auto; 
            background-color: #343a40; 
            color: white;
            text-align: center;
            padding: 10px;
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
            <span class="fw-bold fs-4 text-white">Bienvenido, <?= htmlspecialchars($usuario) ?></span>
        </div>

        <div class="me-3">
            <a href="logout.php" class="btn btn-danger btn-lg px-4">Cerrar sesión</a>
        </div>
    </div>
</nav>


<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-2 d-flex align-items-center justify-content-center">
            <img src="img/medicina.jpg" class="img-fluid rounded shadow-lg" alt="Imagen médica" style="max-width: 180px;">
        </div>

        <div class="col-md-8">
            <div class="card p-4 shadow-lg">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="fw-bold text-success">Mis Citas</h2>
                    <a href="agendar.php" class="btn btn-primary btn-lg shadow">+ Agendar Cita</a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered text-center w-100">
                        <thead class="table-success">
                            <tr>
                                <th>Nombre</th>
                                <th>Servicio</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($cita = $resultado->fetch_assoc()) { 
                                $icono = "";
                                switch ($cita["servicio"]) {
                                    case "Médico General": $icono = "🩺"; break;
                                    case "Odontología": $icono = "🦷"; break;
                                    case "Dermatólogo": $icono = "🌿"; break;
                                    case "Oftalmólogo": $icono = "👁"; break;
                                    case "Otorrinolaringólogo": $icono = "👂"; break;
                                }
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($cita["nombre"]) ?></td>
                                    <td><?= $icono . " " . htmlspecialchars($cita["servicio"]) ?></td>
                                    <td><?= htmlspecialchars($cita["fecha"]) ?></td>
                                    <td><?= date("g:i A", strtotime($cita["hora"])) ?></td>
                                    <td>
                                        <a href='editar.php?id=<?= $cita["id"] ?>' class='btn btn-warning btn-sm'>Editar</a>
                                        <a href='eliminar_cita.php?id=<?= $cita["id"] ?>' class='btn btn-danger btn-sm' onclick="return confirmDelete()">Eliminar</a>
                                        <script>
                                            function confirmDelete() {
                                            return confirm("¿Estás seguro de que quieres eliminar esta cita? Si haces clic en 'Sí', se eliminará permanentemente.");
                                            }
                                        </script>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-2 d-flex align-items-center justify-content-center">
            <img src="img/medicina2.jpg" class="img-fluid rounded shadow-lg" alt="Imagen médica" style="max-width: 180px;">
        </div>
    </div>
</div>

<footer class="text-center">
    <p>Todos los derechos reservados © 2025 - Wilmer Niño Luna - Programa ADSO</p>
</footer>

</body>
</html>


















