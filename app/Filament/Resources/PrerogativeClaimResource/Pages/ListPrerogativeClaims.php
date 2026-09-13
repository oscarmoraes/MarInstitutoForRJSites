<?php

namespace App\Filament\Resources\PrerogativeClaimResource\Pages;

use App\Filament\Resources\PrerogativeClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrerogativeClaims extends ListRecords
{
    protected static string $resource = PrerogativeClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
