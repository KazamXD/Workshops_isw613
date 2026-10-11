<?php
session_start();
require_once __DIR__ . "/connection.php";

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