<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Matrículas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <div class="container">

        <a class="navbar-brand" href="<?= site_url('/') ?>">
            Sistema de Matrículas
        </a>

        <div class="navbar-nav">
            <a class="nav-link text-white" href="<?= site_url('/') ?>">
                Matrícula
            </a>

            <a class="nav-link text-white" href="<?= site_url('cursos') ?>">
                Cursos
            </a>
        </div>

    </div>
</nav>

<div class="container py-4">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <?php if ($errors = session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>