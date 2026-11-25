<?= $this->include('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-7">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-success text-white p-3">
                <h4 class="mb-0">Matrícula finalizada</h4>
            </div>

            <div class="card-body p-4">

                <h5 class="text-success mb-3">
                    ¡Registro realizado correctamente!
                </h5>

                <p class="text-muted">
                    Estos son los datos de su matrícula.
                </p>

                <table class="table table-bordered">

                    <tr>
                        <th>Número de matrícula</th>
                        <td><?= esc($matricula['id']) ?></td>
                    </tr>

                    <tr>
                        <th>Estudiante</th>
                        <td><?= esc($matricula['nombre_estudiante']) ?></td>
                    </tr>

                    <tr>
                        <th>Carné</th>
                        <td><?= esc($matricula['carne']) ?></td>
                    </tr>

                    <tr>
                        <th>Curso</th>
                        <td><?= esc($matricula['curso']) ?></td>
                    </tr>

                    <tr>
                        <th>Código</th>
                        <td><?= esc($matricula['codigo']) ?></td>
                    </tr>

                    <tr>
                        <th>Créditos</th>
                        <td><?= esc($matricula['creditos']) ?></td>
                    </tr>

                    <tr>
                        <th>Carrera</th>
                        <td><?= esc($matricula['carrera']) ?></td>
                    </tr>

                    <tr>
                        <th>Fecha de matrícula</th>
                        <td><?= esc($matricula['fecha_matricula']) ?></td>
                    </tr>

                </table>

                <a href="<?= site_url('/') ?>" class="btn btn-primary w-100">
                    Realizar otra matrícula
                </a>

            </div>
        </div>

    </div>
</div>

<?= $this->include('layout/footer') ?>