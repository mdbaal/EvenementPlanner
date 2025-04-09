<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    protected string $role = "";

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['role'] = User::find($data['id'])->getRoleNames()[0];

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->role =  $data['role'];

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        $record->assignRole(Role::where('name',$this->role)->first());

        $this->role = "";

        return $record;
    }
}
