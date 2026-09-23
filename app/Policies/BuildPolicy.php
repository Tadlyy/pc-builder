<?php

namespace App\Policies;

use App\Models\Build;
use App\Models\User;

class BuildPolicy
{
    public function view(User $user, Build $build): bool
    {
        return $build->is_public || $build->user_id === $user->id;
    }

    public function update(User $user, Build $build): bool
    {
        return $build->user_id === $user->id;
    }

    public function delete(User $user, Build $build): bool
    {
        return $build->user_id === $user->id;
    }
}
