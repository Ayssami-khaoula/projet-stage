<?php

namespace App\Filament\Resources\EvaluationsResource\Pages;

use App\Filament\Resources\EvaluationsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvaluations extends EditRecord
{
    protected static string $resource = EvaluationsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
