<?php

namespace App\Filament\Resources\FormationsResource\Pages;

use App\Filament\Resources\FormationsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormations extends ListRecords
{
    protected static string $resource = FormationsResource::class;
    protected function getHeaderWidgets(): array
    {
        return [
            FormationsResource\Widgets\StatsOverview::class,
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
