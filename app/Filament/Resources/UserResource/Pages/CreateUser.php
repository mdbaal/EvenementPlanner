<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Spatie\Permission\Models\Role;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected string $role = "";

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->role =  $data['role'];

        return $data;
    }

    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
        $user = User::latest()->first();

        $user->assignRole(Role::where('name',$this->role)->first());

        $user->save();
        $this->role = "";
    }
}


