<?php
require_once __DIR__ . '/../utils/auth.php';
require_once __DIR__ . '/../utils/database.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/courses.php');
    exit;
}

// Recibimos los datos
$id = $_POST['id'] ?? null;
$course_code = trim($_POST['course_code'] ?? '');
$name = trim($_POST['name'] ?? '');
$career_id = $_POST['career_id'] ?? null;
$credits = $_POST['credits'] ?? null;
$description = trim($_POST['description'] ?? '');

// Validación básica
if ($course_code === '' || $name === '' || $career_id === null || $credits === null) {
    header('Location: ../pages/course_edit.php?error=invalid_input');
    exit;
}

try {
    if ($id) {
        // UPDATE (Actualizar)
        $stmt = $conn->prepare('UPDATE Courses SET name = :name, course_code = :course_code, career_id = :career_id, credits = :credits, description = :description WHERE id = :id');
        $stmt->execute([
            'name' => $name, 'course_code' => $course_code, 
            'career_id' => $career_id, 'credits' => $credits, 
            'description' => $description, 'id' => $id
        ]);
    } else {
        // INSERT (Crear)
        $stmt = $conn->prepare('INSERT INTO Courses (name, course_code, career_id, credits, description) VALUES (:name, :course_code, :career_id, :credits, :description)');
        $stmt->execute([
            'name' => $name, 'course_code' => $course_code, 
            'career_id' => $career_id, 'credits' => $credits, 
            'description' => $description
        ]);
    }
    
    // Redirigir al listado con éxito
    header('Location: ../pages/courses.php?success=saved');
    exit;

} catch (PDOException $exception) {
    error_log('Course save error: ' . $exception->getMessage());
    // Si el código de curso se duplica (UNIQUE), caerá aquí
    header('Location: ../pages/course_edit.php?error=db_error');
    exit;
}