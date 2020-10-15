<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ValidateFieldMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $config = $request->route()[1]['validate'] ?? null;
        if (is_null($config)) {
            throw new InvalidArgumentException('Config validate_field requested but validate field not found');
        }
        $fields = config("validate_middleware.$config.fields");
        $messages = config("validate_middleware.$config.messages");
        if (! is_array($fields) || ! is_array($messages)) {
            throw new InvalidArgumentException('Validate field config not found or not implemented');
        }

        // Validate just fields requested if method not POST
        $requestFields = $request->all();
        $fieldsToValidate = $fields;
        if (! $request->isMethod('POST') && ! $request->isMethod('PUT')) {
            $requestKeys = array_keys($requestFields);
            $requestKeys =  array_flip($requestKeys);
            $fieldsToValidate = array_intersect_key($fields, $requestKeys);
        }
        Validator::make($requestFields, $fieldsToValidate, $messages)->validate();
        return $next($request);
    }
}
