<?php

namespace App\Filament\Resources\FormationsResource\Pages;

use App\Filament\Resources\FormationsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFormations extends CreateRecord
{
    protected static string $resource = FormationsResource::class;
    protected function getRedirectUrl(): string
    {
     return $this->getResource()::getUrl('index');
    }
}
