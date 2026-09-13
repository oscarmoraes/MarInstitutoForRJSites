<?php

namespace App\Filament\Resources\PrerogativeClaimResource\Pages;

use App\Filament\Resources\PrerogativeClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrerogativeClaim extends EditRecord
{
    protected static string $resource = PrerogativeClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
