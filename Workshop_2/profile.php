<?php
session_start();
require_once __DIR__ . "/connection.php";

// Verify that the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: /index.php");
    exit;
}

$userId = $_SESSION["user_id"];
$error = "";
$success = "";

// Process profile update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";
    $provinceID = $_POST["provinceID"] ?? "";
    if ($username === "" || $provinceID === "") {
        $error = "Complete todos los campos obligatorios.";
    } else {
        // Update username and province
        $stmt = $conn->prepare(
            "UPDATE Users
             SET user = ?, provinceID = ?
             WHERE id = ?"
        );
        $stmt->execute([
            $username,
            $provinceID,
            $userId
        ]);
        // Update password only if a new one was entered
        if ($password !== "") {
            $stmt = $conn->prepare(
                "UPDATE Users SET password = ? WHERE id = ?"
            );

            $stmt->execute([$password, $userId]);
        }
        $_SESSION["user"] = $username;
        $success = "Perfil actualizado correctamente.";
    }
}

// Get the current user's information
$stmt = $conn->prepare(
    "SELECT id, user, password, provinceID
     FROM Users
     WHERE id = ?"
);

$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    session_destroy();
    header("Location: /index.php");
    exit;
}

// Get available provinces
$stmt = $conn->query(
    "SELECT id, province FROM Province ORDER BY province"
);
$provincias = $stmt->fetchAll();
?>
<?php require_once __DIR__ . "/pages/common/header.php"; ?>
<div class="container mt-5">
    <h1 class="text-center">Mi perfil</h1>

    <?php if ($error !== ""): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if ($success !== ""): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"> Editar perfil</div>
                <div class="card-body">
                    <form action="profile.php" method="POST">
                        <div class="form-group">
                            <label for="username">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user["user"]) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password"> Nueva contraseña </label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Dejar vacío para mantener la actual">
                        </div>
                        <div class="form-group">
                            <label for="provinceID">Provincia</label>
                            <select class="form-control" id="provinceID" name="provinceID" required>
                                <?php foreach ($provincias as $provincia): ?>
                                    <option value="<?= $provincia["id"] ?>"
                                        <?= (string) $provincia["id"] ===
                                            (string) $user["provinceID"]
                                            ? "selected" : "" ?> >
                                        <?= htmlspecialchars($provincia["province"]) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Guardar cambios</button>
                        <a href="index.php" class="btn btn-secondary btn-block">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . "/pages/common/footer.php"; ?>
