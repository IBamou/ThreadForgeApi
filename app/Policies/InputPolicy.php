<?php

namespace App\Policies;

use App\Models\Input;
use App\Models\User;

class InputPolicy
{
    public function view(User $user, Input $input): bool
    {
        return $user->is($input->user);
    }

    public function update(User $user, Input $input): bool
    {
        return $user->is($input->user);
    }

    public function archive(User $user, Input $input): bool
    {
        return $user->is($input->user);
    }

    public function restore(User $user, Input $input): bool
    {
        return $user->is($input->user);
    }

    public function forceDelete(User $user, Input $input): bool
    {
        return $user->is($input->user);
    }
}
