<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);

    $query = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
        $error = "Este correo ya está registrado.";
    } else {
        $query = $conexion->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        $query->bind_param("sss", $nombre, $email, $password);
        if ($query->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Error al registrar. Inténtelo nuevamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #D9D9D9; 
            color: #000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background: #F5F5F5;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        h2 {
            font-size: 26px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
            font-size: 16px;
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            background-color: #27AE60; 
            color: white;
            border: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-register:hover {
            background-color: #1E8449;
        }

        .login-link {
            margin-top: 10px;
            display: block;
            font-size: 14px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .sena-logo {
            width: 100px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<img src="img/sena_logo.png" alt="Logo SENA" class="sena-logo">

<div class="register-container">
    <h2>Registro</h2>

    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

    <form action="registro.php" method="POST">
        <div class="mb-3">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required autocomplete="off">
        </div>
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required autocomplete="off">
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
        </div>
        <button type="submit" class="btn btn-register">Registrarse</button>
    </form>

    <a href="login.php" class="login-link">¿Ya tienes cuenta? Inicia sesión aquí</a>
</div>

</body>
</html>

