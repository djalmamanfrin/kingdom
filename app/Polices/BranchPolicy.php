<?php

namespace App\Polices;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BranchPolicy
{
    public function access(User $user, Branch $branch)
    {
        $responsible = $user->profile();
        return $responsible->getId() === $branch->responsible_id
            ? Response::allow()
            : Response::deny('Request unauthorized because this branch does not belong to you', 403);
    }
}
