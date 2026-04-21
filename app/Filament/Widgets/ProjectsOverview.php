<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Filament\Resources\Projects\ProjectResource;

class ProjectsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Proyectos Registrados', Project::count())
                ->description('Total de proyectos en el portafolio')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('success')
                ->url(ProjectResource::getUrl('index')),
        ];
    }
}
