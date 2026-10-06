<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Workshop1";
$error = isset($_GET["error"]) && is_string($_GET["error"]) ? $_GET["error"] : "";

// -- Create connection --
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

// -- Process form --
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["username"] ?? "";
    $enteredPassword = $_POST["password"] ?? "";
    if (empty($usuario) || empty($enteredPassword)) {
        $error = "Llena todos los campos";
    } else {
        $stmt = $conn->prepare(
            "SELECT id, user, password FROM Users WHERE user = ?"
        );
        $stmt->bindValue(1, $usuario, PDO::PARAM_STR);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila) {
            // User found, check password
            if ($enteredPassword === $fila["password"]) {
                $_SESSION["user"] = $fila["user"];
                $_SESSION["user_id"] = $fila["id"];
                header("Location: success.php");
                exit;
            } else {
                // Wrong password
                header("Location: login.php?error=" . urlencode("credenciales Inválidas"));
                exit;
            }
        } else {
            // User not found
            header("Location: login.php?error=" . urlencode("credenciales Inválidas"));
            exit;
        }
    }
}
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
                    <form method="POST">
                        <div class="form-group">
                            <label for="username"> Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password"> Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"> Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>