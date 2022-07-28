<?php

namespace App\Filament\Resources\FormateursResource\Pages;

use App\Filament\Resources\FormateursResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormateurs extends EditRecord
{
    protected static string $resource = FormateursResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
