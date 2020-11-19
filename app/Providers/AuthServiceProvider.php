<?php

namespace App\Providers;

use App\Models\Branch;
use App\Models\Church;
use App\Models\Company;
use App\Models\Entrepreneur;
use App\Models\Responsible;
use App\Models\User;
use App\Polices\BranchPolicy;
use App\Polices\ChurchPolicy;
use App\Polices\CompanyPolicy;
use App\Polices\UserPolicy;
use Firebase\JWT\JWT;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {}

    public function boot()
    {
        // Authorization
        // Gates
        Gate::define('entrepreneur', function (User $user) {
            $type = $user->profile()->type();
            $isEntrepreneur = $type === Entrepreneur::TYPE;
            return $isEntrepreneur || $user->is_admin
                ? Response::allow()
                : Response::deny("Your user type is $type. Only entrepreneur user type have access", 403);
        });
        Gate::define('responsible', function (User $user) {
            $type = $user->profile()->type();
            $isResponsible =  $type === Responsible::TYPE;
            return $isResponsible || $user->is_admin
                ? Response::allow()
                : Response::deny("Your user type is $type. Only responsible user type have access", 403);
        });
        //Policies
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Branch::class, BranchPolicy::class);
        Gate::policy(Church::class, ChurchPolicy::class);
        Gate::policy(Company::class, CompanyPolicy::class);

        // Authentication
        $this->app['auth']->viaRequest('api', function (Request $request) {
            if (! $request->hasHeader('Authorization')) {
                return null;
            }
            $token = str_replace('Bearer ', '', $request->header('Authorization'));
            $data = JWT::decode($token, env('JWT_KEY'), ['HS256']);
            return User::query()->where('email', $data->email)->first();
        });
    }
}
