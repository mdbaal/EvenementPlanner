<?php

namespace App\Filament\Resources\EventManagerResource\Pages;

use App\Filament\Resources\EventManagerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventManager extends EditRecord
{
    protected static string $resource = EventManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
