<?php

namespace App\Controllers;

use App\Models\CursoModel;
use App\Models\CarreraModel;

class CursoController extends BaseController
{
    protected $cursoModel;
    protected $carreraModel;

    public function __construct()
    {
        $this->cursoModel = new CursoModel();
        $this->carreraModel = new CarreraModel();
    }

    // Listar cursos
    public function index()
    {
        $data['cursos'] = $this->cursoModel->obtenerCursos();

        return view('cursos/index', $data);
    }

    // Mostrar formulario de creación
    public function crear()
    {
        $data['carreras'] = $this->carreraModel->findAll();

        return view('cursos/crear', $data);
    }

    // Guardar nuevo curso
    public function guardar()
    {
        $reglas = [
            'nombre' => 'required|max_length[100]',
            'codigo' => 'required|max_length[20]|is_unique[cursos.codigo]',
            'creditos' => 'required|integer|greater_than_equal_to[0]',
            'carrera_id' => 'required|integer|is_not_unique[carreras.id]'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->cursoModel->insert([
            'nombre' => $this->request->getPost('nombre'),
            'codigo' => $this->request->getPost('codigo'),
            'creditos' => $this->request->getPost('creditos'),
            'carrera_id' => $this->request->getPost('carrera_id')
        ]);

        return redirect()->to(site_url('cursos'))
            ->with('success', 'Curso registrado correctamente.');
    }

    // Mostrar formulario de edición
    public function editar($id)
    {
        $data['curso'] = $this->cursoModel->find($id);
        $data['carreras'] = $this->carreraModel->findAll();

        if (!$data['curso']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('cursos/editar', $data);
    }

    // Actualizar curso
    public function actualizar($id)
    {
        if (!$this->cursoModel->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $reglas = [
            'nombre' => 'required|max_length[100]',
            'codigo' => "required|max_length[20]|is_unique[cursos.codigo,id,$id]",
            'creditos' => 'required|integer|greater_than_equal_to[0]',
            'carrera_id' => 'required|integer|is_not_unique[carreras.id]'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->cursoModel->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'codigo' => $this->request->getPost('codigo'),
            'creditos' => $this->request->getPost('creditos'),
            'carrera_id' => $this->request->getPost('carrera_id')
        ]);

        return redirect()->to(site_url('cursos'))
            ->with('success', 'Curso actualizado correctamente.');
    }

    // Eliminar curso
    public function eliminar($id)
    {
        $matriculaModel = new \App\Models\MatriculaModel();

        if ($matriculaModel->where('curso_id', $id)->countAllResults() > 0) {
            return redirect()->to(site_url('cursos'))
                ->with('error', 'No se puede eliminar un curso con matrículas.');
        }

        $this->cursoModel->delete($id);

        return redirect()->to(site_url('cursos'))
            ->with('success', 'Curso eliminado correctamente.');
    }
}