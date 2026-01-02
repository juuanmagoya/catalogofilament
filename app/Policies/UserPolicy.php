<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Ver lista de usuarios
     */
    public function viewAny(User $authUser): bool
    {
        // Super admin puede ver todo
        if ($authUser->tenant_id === null) {
            return true;
        }

        // Usuarios de tenant: solo dentro de su tenant
        return tenant() !== null;
    }

    /**
     * Ver un usuario específico
     */
    public function view(User $authUser, User $user): bool
    {
        if ($authUser->tenant_id === null) {
            return true;
        }

        return $authUser->tenant_id === $user->tenant_id;
    }

    /**
     * Crear usuarios
     */
    public function create(User $authUser): bool
    {
        // Super admin crea usuarios libremente
        if ($authUser->tenant_id === null) {
            return true;
        }

        // Usuarios de tenant pueden crear usuarios en su tenant
        return tenant() !== null;
    }

    /**
     * Actualizar usuario
     */
    public function update(User $authUser, User $user): bool
    {
        if ($authUser->tenant_id === null) {
            return true;
        }

        return $authUser->tenant_id === $user->tenant_id;
    }

    /**
     * Eliminar usuario
     */
    public function delete(User $authUser, User $user): bool
    {
        // Solo super admin elimina
        return $authUser->tenant_id === null;
    }
}
