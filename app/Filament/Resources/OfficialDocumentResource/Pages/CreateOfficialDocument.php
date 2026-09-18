<?php

namespace App\Filament\Resources\OfficialDocumentResource\Pages;

use App\Filament\Resources\OfficialDocumentResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateOfficialDocument extends CreateRecord
{
    protected static string $resource = OfficialDocumentResource::class;

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
