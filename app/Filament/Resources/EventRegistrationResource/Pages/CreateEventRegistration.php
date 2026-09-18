<?php

namespace App\Filament\Resources\EventRegistrationResource\Pages;

use App\Filament\Resources\EventRegistrationResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateEventRegistration extends CreateRecord
{
    protected static string $resource = EventRegistrationResource::class;

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
