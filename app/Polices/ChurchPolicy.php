<?php

namespace App\Polices;

use App\Models\Branch;
use App\Models\Church;
use App\Models\Responsible;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChurchPolicy
{
    public function access(User $user, Church $church)
    {
        /** @var Responsible $responsible */
        $responsible = $user->profile();
        $churchIds = $responsible
            ->branches()
            ->map(function (Branch $branch) {
                return $branch->churches()->pluck('id');
            })
            ->get(0)->toArray();
        return in_array($church->id, $churchIds)
            ? Response::allow()
            : Response::deny('Request unauthorized because this church does not belong to you', 403);
    }
}
