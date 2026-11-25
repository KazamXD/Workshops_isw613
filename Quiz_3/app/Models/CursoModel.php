<?php

namespace App\Models;

use CodeIgniter\Model;

class CursoModel extends Model
{
    protected $table = 'cursos';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre',
        'codigo',
        'creditos',
        'carrera_id'
    ];

    public function obtenerCursos()
    {
        return $this->select('cursos.*, carreras.nombre AS carrera')
                    ->join('carreras', 'carreras.id = cursos.carrera_id')
                    ->findAll();
    }
}