<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    
    protected function beforeCreate(): void //Bloquear el acceso si no hay tenant
    {
        abort_if(! tenant(), 403);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Reafirmamos el tenant
        $data['tenant_id'] = tenant()->id;//Evita que se pueda cambiar el tenant_id desde el formulario

        return $data;
    }
}
