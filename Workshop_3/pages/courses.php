<?php
require_once __DIR__ . '/../utils/auth.php';
require_once __DIR__ . '/../utils/database.php';
requireLogin();
?>
<?php require_once 'common/header.php'; ?>

<body>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Cursos Disponibles</h1>
        <a href="course_edit.php" class="btn btn-success">+ Nuevo Curso</a>
    </div>

    <?php
    try {
        $stmt = $conn->prepare('SELECT id, name, course_code, career_id, credits, description FROM Courses ORDER BY id DESC');
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Courses error: ' . $exception->getMessage());
        $courses = [];
    }
    ?>

    <?php if (empty($courses)): ?>
        <div class="alert alert-info">No hay cursos registrados.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Carrera</th>
                        <th>Créditos</th>
                        <th>Acciones</th> <!-- NUEVA COLUMNA -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($course['course_code']) ?></strong></td>
                            <td><?= htmlspecialchars($course['name']) ?></td>
                            <td><?= htmlspecialchars($course['career_id']) ?></td>
                            <td><?= htmlspecialchars($course['credits']) ?></td>
                            <td>
                                <!-- Botón Editar (manda el ID por la URL) -->
                                <a href="course_edit.php?id=<?= $course['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                
                                <!-- Botón Eliminar (usa un formulario POST por seguridad) -->
                                <form action="../actions/course_delete.php" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este curso?');">
                                    <input type="hidden" name="id" value="<?= $course['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    
    <div class="mt-4">
      <a href="dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
    </div>
  </div>
<?php require_once 'common/footer.php'; ?>