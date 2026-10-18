<?php
require_once __DIR__ . '/../utils/auth.php';
require_once __DIR__ . '/../utils/database.php'; // <-- IMPORTANTE: Traer la conexión a la BD
requireLogin();
?>
<?php require_once 'common/header.php'; ?>

<body>
  <div class="container mt-5">
    <h1 class="mb-4">Cursos Disponibles</h1>

    <?php
    try {
        // 1. Preparamos la consulta (buena práctica contra inyecciones SQL)
        $stmt = $conn->prepare('SELECT id, name, course_code, career_id, credits, description FROM Courses');
        
        // 2. Ejecutamos la consulta
        $stmt->execute();
        
        // 3. Traemos todos los resultados como un arreglo asociativo
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $exception) {
        error_log('Courses error: ' . $exception->getMessage());
        $courses = []; // Si falla, dejamos el arreglo vacío
        echo '<div class="alert alert-danger">Error al cargar los cursos.</div>';
    }
    ?>

    <?php if (empty($courses)): ?>
        <!-- Si no hay cursos, mostramos este mensaje -->
        <div class="alert alert-info">No hay cursos registrados en este momento.</div>
    <?php else: ?>
        <!-- Si hay cursos, los mostramos en una tabla bonita de Bootstrap -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Carrera (ID)</th>
                        <th>Créditos</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <!-- htmlspecialchars evita ataques XSS si alguien mete código HTML en la BD -->
                            <td><strong><?= htmlspecialchars($course['course_code']) ?></strong></td>
                            <td><?= htmlspecialchars($course['name']) ?></td>
                            <td><?= htmlspecialchars($course['career_id']) ?></td>
                            <td><?= htmlspecialchars($course['credits']) ?></td>
                            <td><?= htmlspecialchars($course['description']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    
    <div class="text-center mt-4">
      <a href="dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
    </div>
  </div>
<?php require_once 'common/footer.php'; ?>