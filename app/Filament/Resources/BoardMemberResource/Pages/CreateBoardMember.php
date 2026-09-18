<?php

namespace App\Filament\Resources\BoardMemberResource\Pages;

use App\Filament\Resources\BoardMemberResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateBoardMember extends CreateRecord
{
    protected static string $resource = BoardMemberResource::class;

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
