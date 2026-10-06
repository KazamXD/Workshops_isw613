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
                header("Location: index.php?error=" . urlencode("credenciales Inválidas"));
                exit;
            }
        } else {
            // User not found
            header("Location: index.php?error=" . urlencode("credenciales Inválidas"));
            exit;
        }
    }
}
?>