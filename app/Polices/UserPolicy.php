<?php

namespace App\Polices;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function access(User $auth, User $model)
    {
        $isOwner = $auth->id === $model->id;
        return $isOwner === $auth->is_admin
            ? Response::allow()
            : Response::deny('Request unauthorized because this user data does not belong to you', 403);
    }
}
