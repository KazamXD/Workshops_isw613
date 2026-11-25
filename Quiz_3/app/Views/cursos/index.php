<?= $this->include('layout/header') ?>

<div class="card shadow-sm border-0">

    <div class="card-header bg-primary text-white d-flex 
                justify-content-between align-items-center p-3">

        <h4 class="mb-0">Gestión de cursos</h4>

        <a href="<?= site_url('cursos/crear') ?>" class="btn btn-light">
            + Nuevo curso
        </a>

    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Créditos</th>
                        <th>Carrera</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($cursos as $curso): ?>

                        <tr>
                            <td><?= esc($curso['id']) ?></td>
                            <td><?= esc($curso['codigo']) ?></td>
                            <td><?= esc($curso['nombre']) ?></td>
                            <td><?= esc($curso['creditos']) ?></td>
                            <td><?= esc($curso['carrera']) ?></td>

                            <td>
                                <a href="<?= site_url('cursos/editar/' . $curso['id']) ?>"
                                   class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form action="<?= site_url('cursos/eliminar/' . $curso['id']) ?>"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('¿Desea eliminar este curso?');">

                                    <?= csrf_field() ?>

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>

                                </form>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                    <?php if (empty($cursos)): ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                No hay cursos registrados.
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>

            </table>
        </div>

    </div>
</div>

<?= $this->include('layout/footer') ?>