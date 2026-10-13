<?php
session_start();
$error = $_GET["error"] ?? "";
$registered = isset($_GET["registered"]);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Workshop 1</title>

    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    >
</head>

<body>

<div class="container mt-5">
    <h1 class="text-center">Iniciar sesión</h1>
    <p class="text-center">
        Ingrese sus credenciales para acceder al sistema.
    </p>
    <?php if ($registered): ?>
        <div class="alert alert-success text-center">
            Cuenta creada correctamente. Ya puede iniciar sesión.
        </div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>

        <div class="alert alert-danger text-center">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label for="username"> Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password"> Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"> Ingresar</button>
                        <div class="text-center mt-3">
                            <p>¿No tienes una cuenta?</p>
                            <a href="actions/register.php" class="btn btn-success btn-block"> Registrarse</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>