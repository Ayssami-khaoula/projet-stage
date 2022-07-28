<?php

namespace App\Filament\Resources\EvaluationsResource\Pages;

use App\Filament\Resources\EvaluationsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvaluations extends ListRecords
{
    protected static string $resource = EvaluationsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
