<?php

namespace App\Filament\Resources\PrerogativeClaimResource\Pages;

use App\Filament\Resources\PrerogativeClaimResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreatePrerogativeClaim extends CreateRecord
{
    protected static string $resource = PrerogativeClaimResource::class;

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->hidden();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
