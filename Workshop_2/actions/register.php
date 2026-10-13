<?php
require_once __DIR__ . "/../connection.php";

// -- Process form --
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    $provincia = $_POST["province_id"] ?? "";

    $stmt = $conn->prepare(
        "INSERT INTO Users (user, password, provinceID)
         VALUES (?, ?, ?)"
    );

    $stmt->execute([
        $usuario,
        $password,
        $provincia
    ]);

    header("Location: ../index.php");
    exit;
}

// Get the list of provinces from the database
$stmt = $conn->query("SELECT id, province FROM Province ORDER BY id");
$provincias = $stmt->fetchAll();
?>


<?php require_once __DIR__ . "/../pages/common/header.php"; ?>
<body>
    <div class="container mt-5">
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Crear cuenta</h4>
                    </div>
                    <div class="card-body">
                        <form action="register.php" method="POST">
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
                                <select class="form-control" id="province" name="province_id" required>
                                    <option value="">Seleccione una provincia</option>
                                    <?php foreach ($provincias as $provincia): ?>
                                        <option value="<?= htmlspecialchars((string) $provincia["id"]) ?>">
                                            <?= htmlspecialchars($provincia["province"]) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block"> Registrarse</button>
                            <a href="../index.php" class="btn btn-secondary btn-block"> Volver al inicio de sesión</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require_once __DIR__ . "/../pages/common/footer.php"; ?>
