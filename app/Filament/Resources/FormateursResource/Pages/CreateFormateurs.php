<?php

namespace App\Filament\Resources\FormateursResource\Pages;

use App\Filament\Resources\FormateursResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFormateurs extends CreateRecord
{
    protected static string $resource = FormateursResource::class;
    protected function getRedirectUrl(): string
    {
     return $this->getResource()::getUrl('index');
    }
}
