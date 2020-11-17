<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        try {
            $user = User::query()
                ->where('email', $request->get('email'))
                ->where('password', $request->get('password'))
                ->first();
            if (! $user instanceof User) {
                throw new InvalidArgumentException('Email or password unknown', 401);
            }
            $token = JWT::encode(['email' => $user->email], env('JWT_KEY'));
            return responseHandler()->success(Response::HTTP_CREATED, ['access_token' => $token]);
        } catch (Exception $e) {
            return responseHandler()->error($e);
        }
    }
}
