<?php
include("conexion.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $query = $conexion->prepare("SELECT id, password, rol FROM usuarios WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $resultado = $query->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($password, $usuario["password"])) {
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_rol"] = $usuario["rol"]; 

            if ($usuario["rol"] == "Administrador") {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "No existe una cuenta con este correo.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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

        .login-container {
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

        .btn-login {
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

        .btn-login:hover {
            background-color: #1E8449;
        }

        .register-link {
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

<div class="login-container">
    <h2>Iniciar Sesión</h2>
    
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    
    <form action="login.php" method="POST">
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required autocomplete="off">
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
        </div>
        <button type="submit" class="btn btn-login">Iniciar Sesión</button>
    </form>
    
    <a href="registro.php" class="register-link">¿No tienes cuenta? Regístrate aquí</a>
</div>

</body>
</html>

