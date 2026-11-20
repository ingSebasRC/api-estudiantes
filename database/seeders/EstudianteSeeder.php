<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use Illuminate\Database\Seeder;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        $estudiantes = [
            ['nombre' => 'Sebastián Rodríguez', 'correo' => 'sebastian@aunar.edu.co', 'programa' => 'Ingeniería Informática'],
            ['nombre' => 'Laura Martínez', 'correo' => 'laura.martinez@aunar.edu.co', 'programa' => 'Ingeniería Informática'],
            ['nombre' => 'Carlos Gómez', 'correo' => 'carlos.gomez@aunar.edu.co', 'programa' => 'Administración de Empresas'],
            ['nombre' => 'Ana Sofía Pérez', 'correo' => 'ana.perez@aunar.edu.co', 'programa' => 'Contaduría Pública'],
            ['nombre' => 'Diego Torres', 'correo' => 'diego.torres@aunar.edu.co', 'programa' => 'Ingeniería Industrial'],
        ];

        foreach ($estudiantes as $estudiante) {
            Estudiante::create($estudiante);
        }
    }
}
