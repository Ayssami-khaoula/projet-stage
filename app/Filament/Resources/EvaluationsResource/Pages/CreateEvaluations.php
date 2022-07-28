<?php

namespace App\Filament\Resources\EvaluationsResource\Pages;

use App\Filament\Resources\EvaluationsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEvaluations extends CreateRecord
{
    protected static string $resource = EvaluationsResource::class;
    protected function getRedirectUrl(): string
    {
     return $this->getResource()::getUrl('index');
    }
}
