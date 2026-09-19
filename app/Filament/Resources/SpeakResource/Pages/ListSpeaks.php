<?php

namespace App\Filament\Resources\SpeakResource\Pages;

use App\Filament\Resources\SpeakResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpeaks extends ListRecords
{
    protected static string $resource = SpeakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
