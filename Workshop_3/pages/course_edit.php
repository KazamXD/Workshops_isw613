<?php
require_once __DIR__ . '/../utils/auth.php';
require_once __DIR__ . '/../utils/database.php';
requireLogin();

$course = [
    'id' => '', 'name' => '', 'course_code' => '', 
    'career_id' => '', 'credits' => '', 'description' => ''
];
$isEdit = false;

// Si viene un ID por la URL, es porque vamos a editar
if (isset($_GET['id'])) {
    $isEdit = true;
    $stmt = $conn->prepare('SELECT * FROM Courses WHERE id = :id');
    $stmt->execute(['id' => $_GET['id']]);
    $courseFound = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($courseFound) {
        $course = $courseFound;
    } else {
        header('Location: courses.php?error=not_found');
        exit;
    }
}
?>
<?php require_once 'common/header.php'; ?>

<body>
  <div class="container mt-5">
    <h1 class="mb-4"><?= $isEdit ? 'Editar Curso' : 'Nuevo Curso' ?></h1>

    <div class="card">
        <div class="card-body">
            <!-- Enviamos los datos a actions/course_save.php -->
            <form action="../actions/course_save.php" method="POST">
                
                <!-- ID oculto (solo sirve si estamos editando) -->
                <input type="hidden" name="id" value="<?= htmlspecialchars($course['id']) ?>">

                <div class="form-group">
                    <label>Código del Curso (Ej. INF-101)</label>
                    <input type="text" name="course_code" class="form-control" value="<?= htmlspecialchars($course['course_code']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Nombre del Curso</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($course['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label>ID de la Carrera</label>
                    <input type="number" name="career_id" class="form-control" value="<?= htmlspecialchars($course['career_id']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Créditos</label>
                    <input type="number" name="credits" class="form-control" value="<?= htmlspecialchars($course['credits']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($course['description']) ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Actualizar Curso' : 'Guardar Curso' ?></button>
                <a href="courses.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
  </div>
<?php require_once 'common/footer.php'; ?>