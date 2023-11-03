<?php

namespace App\Policies;

use App\Models\Authorization;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthorizationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Authorization $authorization): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Authorization $authorization): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Authorization $authorization): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Authorization $authorization): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Authorization $authorization): bool
    {
        //
    }

    public function createPost(User $user, Authorization $authorization): bool
    {
        return $authorization->isPostCreator();
    }
    
    public function viewUpdatePost(User $user, Authorization $authorization): bool
    {
        return $authorization->viewUpdatePost();
    }

    public function canDeletePost(User $user, Authorization $authorization): bool {
        return $authorization->canDeletePost();
    }

    public function viewAddProduct(User $user, Authorization $authorization): bool{
        return $authorization->viewAddProduct();
    }
    public function viewUpdateProduct(User $user, Authorization $authorization): bool{
        return $authorization->viewUpdateProduct();
    }
    public function deleteProduct(User $user, Authorization $authorization): bool{
        return $authorization->deleteProduct();
    }

    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdministrator()) {
            return true;
        }
        return null;
    }
}
