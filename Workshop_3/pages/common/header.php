<?php
// Aseguramos que la sesión esté iniciada para poder leer $_SESSION
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <?php if (isset($_SESSION['user_id'])): ?>
    <!-- This menu is only displayed if there is an active session -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
      <div class="container">
        <a class="navbar-brand" href="dashboard.php">Workshop 3</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="./profile.php">Mi Perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="courses.php">Cursos</a>
            </li>
            <li class="nav-item">
              <form action="../actions/logout.php" method="POST" class="form-inline">
                <button type="submit" class="btn btn-link nav-link" style="border: none; background: none;">Cerrar Sesión</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <?php endif; ?>
