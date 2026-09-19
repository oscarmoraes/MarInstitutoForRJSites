<?php

namespace App\Filament\Resources\EventScheduleResource\Pages;

use App\Filament\Resources\EventScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventSchedules extends ListRecords
{
    protected static string $resource = EventScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
