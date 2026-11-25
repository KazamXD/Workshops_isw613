<?php

namespace App\Models;

use CodeIgniter\Model;

class MatriculaModel extends Model
{
    protected $table = 'matriculas';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre_estudiante',
        'carne',
        'curso_id'
    ];

    public function obtenerMatricula($id)
    {
        return $this->select('
                    matriculas.*,
                    cursos.nombre AS curso,
                    cursos.codigo,
                    cursos.creditos,
                    carreras.nombre AS carrera
                ')
                ->join('cursos', 'cursos.id = matriculas.curso_id')
                ->join('carreras', 'carreras.id = cursos.carrera_id')
                ->where('matriculas.id', $id)
                ->first();
    }
}