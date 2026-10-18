<?php

require_once __DIR__ . '/../utils/database.php';

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;
$provinceId = $_POST['province_id'] ?? null;

// Validate the input to ensure that the username and password are strings, not empty, and within reasonable length limits
if (
    !is_string($username)
    || !is_string($password)
    || trim($username) === ''
    || strlen($username) > 50
    || $password === ''
    || strlen($password) < 8   // recomendable: mínimo de longitud
) {
    header('Location: /register.php?error=invalid_input');
    exit;
}

$username = trim($username);

try {
    // Check if the username is already taken
    $check = $conn->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
    $check->execute(['username' => $username]);
    if ($check->fetch()) {
        header('Location: /register.php?error=username_taken');
        exit;
    }

    // bcrypt: hash the password before storing it in the database
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        'INSERT INTO users (username, password_hash, province_id)
         VALUES (:username, :hash, :province_id)'
    );
    $stmt->execute([
        'username'    => $username,
        'hash'        => $hash,
        'province_id' => $provinceId ?: null,
    ]);

    header('Location: ../index.php?success=registered');
    exit;

} catch (PDOException $exception) {
    error_log('Registration error: ' . $exception->getMessage());
    header('Location: /register.php?error=server_error');
    exit;
}