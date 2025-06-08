<?php

namespace App\Policies;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedbackPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Feedback $feedback)
    {
        return $user->isAdmin() || $user->id === $feedback->user_id;
    }

    public function update(User $user, Feedback $feedback)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Feedback $feedback)
    {
        return $user->isAdmin();
    }
} 