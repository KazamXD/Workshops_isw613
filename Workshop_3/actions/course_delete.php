<?php
require_once __DIR__ . '/../utils/auth.php';
require_once __DIR__ . '/../utils/database.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    header('Location: ../pages/courses.php');
    exit;
}

try {
    $stmt = $conn->prepare('DELETE FROM Courses WHERE id = :id');
    $stmt->execute(['id' => $_POST['id']]);
    
    header('Location: ../pages/courses.php?success=deleted');
    exit;
} catch (PDOException $exception) {
    error_log('Course delete error: ' . $exception->getMessage());
    header('Location: ../pages/courses.php?error=db_error');
    exit;
}