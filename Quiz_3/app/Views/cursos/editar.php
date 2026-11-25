<?= $this->include('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-7">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-warning">
                <h4 class="mb-0">Editar curso</h4>
            </div>

            <div class="card-body p-4">

                <form action="<?= site_url('cursos/actualizar/' . $curso['id']) ?>"
                      method="POST">

                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Nombre del curso</label>

                        <input type="text"
                               name="nombre"
                               class="form-control"
                               value="<?= old('nombre', $curso['nombre']) ?>"
                               maxlength="100"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Código del curso</label>

                        <input type="text"
                               name="codigo"
                               class="form-control"
                               value="<?= old('codigo', $curso['codigo']) ?>"
                               maxlength="20"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cantidad de créditos</label>

                        <input type="number"
                               name="creditos"
                               class="form-control"
                               value="<?= old('creditos', $curso['creditos']) ?>"
                               min="0"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Carrera</label>

                        <select name="carrera_id" class="form-select" required>

                            <?php foreach ($carreras as $carrera): ?>

                                <option value="<?= esc($carrera['id']) ?>"
                                    <?= old('carrera_id', $curso['carrera_id']) == $carrera['id']
                                        ? 'selected' : '' ?>>

                                    <?= esc($carrera['nombre']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning">
                        Actualizar curso
                    </button>

                    <a href="<?= site_url('cursos') ?>" class="btn btn-secondary">
                        Cancelar
                    </a>

                </form>

            </div>
        </div>

    </div>
</div>

<?= $this->include('layout/footer') ?>