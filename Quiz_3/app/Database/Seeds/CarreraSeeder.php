<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CarreraSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre' => 'Ingeniería del Software'
            ],
            [
                'nombre' => 'Ingeniería en Tecnologías de Información'
            ],
            [
                'nombre' => 'Administración de Empresas'
            ],
            [
                'nombre' => 'Contabilidad'
            ]
        ];

        foreach ($data as $carrera) {
            $existe = $this->db->table('carreras')
                ->where('nombre', $carrera['nombre'])
                ->countAllResults();

            if (!$existe) {
                $this->db->table('carreras')->insert($carrera);
            }
        }
    }
}