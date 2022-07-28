<?php

namespace App\Filament\Resources\FormationsResource\Pages;

use App\Filament\Resources\FormationsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormations extends EditRecord
{
    protected static string $resource = FormationsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
