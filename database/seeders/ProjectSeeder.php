<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'title' => 'Senado de la República',
            'description' => 'Liderazgo en obras de gran escala y colados masivos.',
            'link' => 'https://www.senado.gob.mx/',
            'tags' => ['infraestructura', 'gobierno'],
        ]);

        Project::create([
            'title' => 'HSBC Coyoacán',
            'description' => 'Coordinación de obra y supervisión técnica.',
            'link' => null,
            'tags' => ['construcción', 'bancario'],
        ]);

        Project::create([
            'title' => 'Remodelación Club France de México',
            'description' => 'Especialista en remodelación comercial y residencial de alto nivel.',
            'link' => 'https://clubfrance.org.mx/',
            'tags' => ['edificación', 'deporte'],
        ]);
    }
}
