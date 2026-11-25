<?php

namespace App\Controllers;

use App\Models\CursoModel;
use App\Models\MatriculaModel;

class MatriculaController extends BaseController
{
    protected $cursoModel;
    protected $matriculaModel;

    public function __construct()
    {
        $this->cursoModel = new CursoModel();
        $this->matriculaModel = new MatriculaModel();
    }

    // Página principal
    public function index()
    {
        $data['cursos'] = $this->cursoModel->obtenerCursos();

        return view('matriculas/index', $data);
    }

    // Registrar matrícula
    public function guardar()
    {
        $reglas = [
            'nombre_estudiante' => 'required|max_length[100]',
            'carne' => 'required|max_length[20]',
            'curso_id' => 'required|integer|is_not_unique[cursos.id]'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $id = $this->matriculaModel->insert([
            'nombre_estudiante' => $this->request->getPost('nombre_estudiante'),
            'carne' => $this->request->getPost('carne'),
            'curso_id' => $this->request->getPost('curso_id')
        ]);

        if (!$id) {
            return redirect()->back()->withInput()
                ->with('error', 'No se pudo registrar la matrícula.');
        }

        return redirect()->to(site_url('matricula/detalle/' . $id))
            ->with('success', 'Matrícula realizada correctamente.');
    }

    // Mostrar datos de la matrícula
    public function detalle($id)
    {
        $data['matricula'] = $this->matriculaModel->obtenerMatricula($id);

        if (!$data['matricula']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('matriculas/detalle', $data);
    }
}