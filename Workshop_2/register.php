<?php
require_once __DIR__ . "/connection.php";

// Get the list of provinces from the database
$stmt = $conn->query("SELECT id, province FROM Province ORDER BY id");
$provincias = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de usuarios</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Registro de usuarios</h1>
        <p class="text-center">
            Complete el formulario para crear una cuenta.
        </p>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Crear cuenta</h4>
                    </div>
                    <div class="card-body">
                        <form action="registrar.php" method="POST">
                            <div class="form-group">
                                <label for="username">Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="province">Provincia</label>
                                <select class="form-control" id="province" name="id" required>
                                    <option value="">Seleccione una provincia</option>
                                    <?php foreach ($provincias as $provincia): ?>
                                        <option value="<?= htmlspecialchars((string) $provincia["id"]) ?>">
                                            <?= htmlspecialchars($provincia["province"]) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block"> Registrarse</button>
                            <a href="index.php" class="btn btn-secondary btn-block"> Volver al inicio de sesión</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
