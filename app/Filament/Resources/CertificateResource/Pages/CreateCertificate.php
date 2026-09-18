<?php

namespace App\Filament\Resources\CertificateResource\Pages;

use App\Filament\Resources\CertificateResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateCertificate extends CreateRecord
{
    protected static string $resource = CertificateResource::class;

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
