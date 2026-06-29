<?php

namespace App\Policies;

use App\Models\Blueprint;
use App\Models\User;

class BlueprintPolicy
{
    public function view(User $user, Blueprint $blueprint): bool
    {
        return $user->is($blueprint->user);
    }

    public function update(User $user, Blueprint $blueprint): bool
    {
        return $user->is($blueprint->user);
    }

    public function archive(User $user, Blueprint $blueprint): bool
    {
        return $user->is($blueprint->user);
    }

    public function restore(User $user, Blueprint $blueprint): bool
    {
        return $user->is($blueprint->user);
    }

    public function forceDelete(User $user, Blueprint $blueprint): bool
    {
        return $user->is($blueprint->user);
    }

}
