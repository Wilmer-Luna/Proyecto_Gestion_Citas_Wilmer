<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Gestión de Citas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #2C3E50; 
            color: #000; 
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container-box {
            background: #F5F5F5; 
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 90%;
            color: #000;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            color: #333; 
        }

        .btn-custom {
            width: 200px;
            font-size: 18px;
            font-weight: bold;
            margin: 10px;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s ease-in-out;
            background-color: #27AE60; 
            color: white;
            text-decoration: none;
            display: inline-block;
            border: none;
        }

        .btn-custom:hover {
            background-color: #1E8449;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: white;
        }

        .sena-logo {
            width: 100px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<img src="img/sena_logo.png" alt="Logo SENA" class="sena-logo">

<div class="container-box">
    <h1>Bienvenido a Gestión de Citas</h1>
    <p class="lead">Administra tus citas de forma rápida y sencilla.</p>
    
    <div class="mt-4">
        <a href="login.php" class="btn btn-custom">Iniciar Sesión</a>
        <a href="registro.php" class="btn btn-custom">Registrarse</a>
    </div>
</div>

<footer class="footer">
    <p>Todos los derechos reservados &copy; 2025 - Wilmer Niño Luna - Programa ADSO</p>
</footer>

</body>
</html>
