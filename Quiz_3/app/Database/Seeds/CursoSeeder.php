<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CursoSeeder extends Seeder
{
    public function run()
    {
        $carreras = $this->db->table('carreras')
            ->get()
            ->getResultArray();

        $ids = array_column($carreras, 'id', 'nombre');

        $data = [
            [
                'nombre' => 'Programación I',
                'codigo' => 'ISW-101',
                'creditos' => 4,
                'carrera_id' => $ids['Ingeniería del Software']
            ],
            [
                'nombre' => 'Bases de Datos',
                'codigo' => 'ISW-201',
                'creditos' => 4,
                'carrera_id' => $ids['Ingeniería del Software']
            ],
            [
                'nombre' => 'Programación Web',
                'codigo' => 'ISW-301',
                'creditos' => 3,
                'carrera_id' => $ids['Ingeniería del Software']
            ],
            [
                'nombre' => 'Redes de Computadoras',
                'codigo' => 'ITI-101',
                'creditos' => 4,
                'carrera_id' => $ids['Ingeniería en Tecnologías de Información']
            ],
            [
                'nombre' => 'Administración General',
                'codigo' => 'ADM-101',
                'creditos' => 3,
                'carrera_id' => $ids['Administración de Empresas']
            ],
            [
                'nombre' => 'Contabilidad I',
                'codigo' => 'CON-101',
                'creditos' => 3,
                'carrera_id' => $ids['Contabilidad']
            ]
        ];

        foreach ($data as $curso) {
            $existe = $this->db->table('cursos')
                ->where('codigo', $curso['codigo'])
                ->countAllResults();

            if (!$existe) {
                $this->db->table('cursos')->insert($curso);
            }
        }
    }
}