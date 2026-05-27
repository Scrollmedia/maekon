<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Direction;
use Illuminate\Auth\Access\HandlesAuthorization;

class DirectionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Direction');
    }

    public function view(AuthUser $authUser, Direction $direction): bool
    {
        return $authUser->can('View:Direction');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Direction');
    }

    public function update(AuthUser $authUser, Direction $direction): bool
    {
        return $authUser->can('Update:Direction');
    }

    public function delete(AuthUser $authUser, Direction $direction): bool
    {
        return $authUser->can('Delete:Direction');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Direction');
    }

    public function restore(AuthUser $authUser, Direction $direction): bool
    {
        return $authUser->can('Restore:Direction');
    }

    public function forceDelete(AuthUser $authUser, Direction $direction): bool
    {
        return $authUser->can('ForceDelete:Direction');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Direction');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Direction');
    }

    public function replicate(AuthUser $authUser, Direction $direction): bool
    {
        return $authUser->can('Replicate:Direction');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Direction');
    }

}