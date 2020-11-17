<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {}

    public function boot()
    {
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
