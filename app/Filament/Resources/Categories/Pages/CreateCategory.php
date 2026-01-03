<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected function beforeCreate(): void //Bloquear el acceso si no hay tenant
    {
        abort_if(! tenant(), 403);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tenant_id'] = tenant()->id;//Se asigna el tenant_id automaticamente del subdominio

        return $data;
    }
}
