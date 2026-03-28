<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            // ACTUAL
            ['title' => 'Remodelación Oficinas Afore Banamex', 'type' => 'actual', 'description' => 'San Luis Potosí - Remodelación de oficinas corporativas.', 'tags' => ['remodelacion', 'oficinas']],
            ['title' => 'Sistemas Eléctricos Suc. Banamex', 'type' => 'actual', 'description' => 'Cd. Juárez - Instalación y mantenimiento de sistemas eléctricos.', 'tags' => ['obra civil', 'electricidad']],
            ['title' => 'Remodelación Suc. Banamex Altamira', 'type' => 'actual', 'description' => 'Remodelación integral de sucursal bancaria.', 'tags' => ['remodelacion', 'banca']],
            ['title' => 'Suc. Banamex Antigua Estación', 'type' => 'actual', 'description' => 'Jojutla - Proyecto de remodelación y adecuación.', 'tags' => ['remodelacion', 'patrimonio']],
            ['title' => 'Suc. Banamex Felipe Ángeles', 'type' => 'actual', 'description' => 'Pachuca - Obra y remodelación de sucursal.', 'tags' => ['remodelacion', 'sucursal']],
            ['title' => 'CEDIS SIGMA Parque Industrial IX', 'type' => 'actual', 'description' => 'Querétaro - Construcción y equipamiento de centro de distribución.', 'tags' => ['infraestructura', 'logistica']],

            // INFRAESTRUCTURA
            ['title' => 'Senado de la República', 'type' => 'infraestructura', 'description' => 'Participación en la construcción del recinto legislativo.', 'tags' => ['obra civil', 'gobierno']],
            ['title' => 'HSBC Coyoacán', 'type' => 'infraestructura', 'description' => 'Obra civil y cimentación profunda.', 'tags' => ['obra civil', 'banca']],
            ['title' => '2do Piso Periférico', 'type' => 'infraestructura', 'description' => 'Satélite a La Quebrada - Colados masivos y trabes.', 'tags' => ['infraestructura', 'vial']],
            ['title' => 'Corporativo AXA Santa Fe', 'type' => 'infraestructura', 'description' => 'Diseño y construcción de espacios corporativos.', 'tags' => ['edificacion', 'oficinas']],
            ['title' => 'Museo de Ciencias e Industria Modelo', 'type' => 'infraestructura', 'description' => 'Toluca - 15,000 m² de construcción industrial y museografía.', 'tags' => ['infraestructura', 'museo']],
            ['title' => 'Naves Industriales Walmart', 'type' => 'infraestructura', 'description' => 'Construcción de centros logísticos a gran escala.', 'tags' => ['infraestructura', 'logistica']],

            // EDIFICACIÓN
            ['title' => 'Remodelación Club France', 'type' => 'edificacion', 'description' => 'México - Remodelación de áreas sociales y deportivas.', 'tags' => ['remodelacion', 'deporte']],
            ['title' => 'Desarrollo Punta Mita Starbucks', 'type' => 'edificacion', 'description' => 'Sheraton - Construcción de local comercial premium.', 'tags' => ['edificacion', 'luxury']],
            ['title' => 'Base Naval Isla Guadalupe', 'type' => 'edificacion', 'description' => 'Obra gubernamental de alta seguridad.', 'tags' => ['obra civil', 'militar']],
            ['title' => 'Hospital General Puerto Vallarta', 'type' => 'edificacion', 'description' => 'Infraestructura hospitalaria y quirófanos.', 'tags' => ['infraestructura', 'salud']],
            ['title' => 'Hospital General Landa de Matamoros', 'type' => 'edificacion', 'description' => 'Obra civil para sector salud.', 'tags' => ['infraestructura', 'salud']],

            // ADICIONALES
            ['title' => 'Cálculo de Estructura Metálica', 'type' => 'obra civil', 'description' => 'Diseño estructural para nave industrial.', 'tags' => ['obra civil', 'calculo']],
            ['title' => 'Remodelación Residencia Lomas', 'type' => 'remodelacion', 'description' => 'Acabados de lujo y redistribución de espacios.', 'tags' => ['remodelacion', 'habitacional']],
            ['title' => 'App Control de Obra v1', 'type' => 'aplicaciones', 'description' => 'Desarrollo de software para seguimiento de bitácora.', 'tags' => ['aplicaciones', 'tecnologia']],
        ];

        foreach ($projects as $idx => $projectData) {
            Project::updateOrCreate(
                ['title' => $projectData['title']],
                array_merge($projectData, [
                    'status' => 'completed',
                    'is_featured' => $idx < 6,
                    'image_path' => 'https://picsum.photos/seed/' . md5($projectData['title']) . '/800/600',
                ])
            );
        }
    }
}
