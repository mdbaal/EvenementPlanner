<?php

namespace App\Filament\Resources\EventManagerResource\Pages;

use App\Filament\Resources\EventManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventManagers extends ListRecords
{
    protected static string $resource = EventManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
