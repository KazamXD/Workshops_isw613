<?= $this->include('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-7">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-primary text-white p-3">
                <h4 class="mb-0">Matrícula de estudiantes</h4>
            </div>

            <div class="card-body p-4">

                <p class="text-muted">
                    Complete sus datos y seleccione el curso que desea matricular.
                </p>

                <form action="<?= site_url('matricula/guardar') ?>" method="POST">

                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Nombre del estudiante</label>

                        <input type="text"
                               name="nombre_estudiante"
                               class="form-control"
                               value="<?= old('nombre_estudiante') ?>"
                               maxlength="100"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Número de carné</label>

                        <input type="text"
                               name="carne"
                               class="form-control"
                               value="<?= old('carne') ?>"
                               maxlength="20"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Curso</label>

                        <select name="curso_id" class="form-select" required>

                            <option value="">Seleccione un curso</option>

                            <?php foreach ($cursos as $curso): ?>

                                <option value="<?= esc($curso['id']) ?>"
                                    <?= old('curso_id') == $curso['id'] ? 'selected' : '' ?>>

                                    <?= esc($curso['codigo']) ?> -
                                    <?= esc($curso['nombre']) ?>
                                    (<?= esc($curso['creditos']) ?> créditos)

                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Matricular
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

<?= $this->include('layout/footer') ?>