<?php

namespace App\Polices;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    public function access(User $user, Company $company)
    {
        $entrepreneur = $user->profile();
        return $entrepreneur->getId() === $company->entrepreneur_id
            ? Response::allow()
            : Response::deny('Request unauthorized because this copmany does not belong to you', 403);
    }
}
