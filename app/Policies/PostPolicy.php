<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function view(User $user, Post $post): bool
    {
        return $user->is($post->user);
    }

    public function update(User $user, Post $post): bool
    {
        return $user->is($post->user);
    }

    public function updateStatus(User $user, Post $post): bool
    {
        return $user->is($post->user);
    }

    public function archive(User $user, Post $post): bool
    {
        return $user->is($post->user);
    }

    public function restore(User $user, Post $post): bool
    {
        return $user->is($post->user);
    }

    public function forceDelete(User $user, Post $post): bool
    {
        return $user->is($post->user);
    }
}
