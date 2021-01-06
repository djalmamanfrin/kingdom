<?php
use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

if (! function_exists('responseHandler')) {
    /**
     * @return App\Handlers\ResponseHandler
     */
    function responseHandler()
    {
        return app(App\Handlers\ResponseHandler::class);
    }
}
// if (! function_exists('now')) {
//     /**
//      * @return Carbon
//      */
//     function now()
//     {
//         return Carbon::now();
//     }
// }
// if (! function_exists('in_array_recursive')) {
//     function in_array_recursive($needles, $haystack)
//     {
//         foreach ($needles as $needle) {
//             if (in_array($needle, $haystack)) {
//                 return true;
//             }
//         }
//         return false;
//     }
// }
if (! function_exists('isDevelop')) {
    /**
     * @return bool
     */
    function isDevelop()
    {
        return (bool) in_array(env('APP_ENV'), ['develop', 'local', 'dev']);
    }
}
if (! function_exists('isTesting')) {
    /**
     * @return bool
     */
    function isTesting()
    {
        return (bool) in_array(env('APP_ENV'), ['test', 'testing']);
    }
}
// if (! function_exists('isStaging')) {
//     /**
//      * @return bool
//      */
//     function isStaging()
//     {
//         return (bool) in_array(env('APP_ENV'), ['staging', 'stg']);
//     }
// }
// if (! function_exists('isProduction')) {
//     /**
//      * @return bool
//      */
//     function isProduction()
//     {
//         return (bool) in_array(env('APP_ENV'), ['production', 'prod', 'prd']);
//     }
// }
if (! function_exists('validate_middleware_fields')) {
    function validate_middleware_fields(string $type): array
    {
        $fields = collect(config("validate_middleware.bank_account.messages"));
        return $fields
            ->filter(function ($field, $key) use ($type){
                return (preg_match("/\.$type/", $key));
            })
            ->map(function ($value, $key) {
                $key = current(explode('.', $key));
                return [$key, $value];
            })
            ->values()
            ->toArray();
    }
}
if (! function_exists('showText')) {
    /**
     * @param string $key
     * @param string|null $arg
     * @param string|string $locale
     * @return string|null
     */
    function showText(string $locale, string $arg = null, string $origin = 'responses')
    {
        $key = "{$origin}.{$locale}" . (! $arg ?: ".{$arg}");
        $text = trans($key);

        return $key === $text
            ? trans("{$origin}.{$locale}.default")
            : $text;
    }
}
// if (! function_exists('broker')) {
//     /**
//      * @param string $topic
//      * @param array $parameters
//      * @return void
//      */
//     function broker(string $topic, array $parameters) : void
//     {
//         $broker = new App\Broker\Handler();
//         $broker->setTopic($topic)
//             ->setEventType(strtoupper($parameters['type']));
//         if (! in_array_recursive(['payload', 'route'], array_keys($parameters))) {
//             throw new \Exception("Payload or Link is required.", 500);
//         }
//         if (key_exists('payload', $parameters)) {
//             $broker->setPayload($parameters['payload']);
//         }
//         if (key_exists('route', $parameters)) {
//             $broker->setLink($parameters['route'], $parameters['route_parameter']);
//         }
//         $broker->publish();
//     }
// }
// if (! function_exists('promise')) {
//     /**
//      * @param array $jobs
//      * @param array $payload
//      * @return App\Promises\Handle
//      */
//     function promise(array $jobs, array $payload) : App\Promises\Handler
//     {
//         return app(App\Promises\Handler::class)
//             ->setJobs($jobs)
//             ->setPayload($payload)
//             ->handle();
//     }
// }
// if (! function_exists('artisan')) {
//     /**
//      * @param  string  $command
//      * @param  array  $parameters
//      * @return int
//      */
//     function artisan(string $command, array $parameters = []) : int
//     {
//         return app(Illuminate\Contracts\Console\Kernel::class)->call($command, $parameters);
//     }
// }
// if (! function_exists('config_json')) {
//     /**
//      * @param string $target
//      * @param string|null $cast
//      * @return mixed
//      */
//     function config_json(string $target, string $cast = null)
//     {
//         $target = explode('.', $target);
//         $filename = sprintf("%s/config/%s.json", base_path(), current($target));
//         try {
//             $file = current(file($filename));
//             $file = json_decode($file, true);
//             if (count($target) > 1) {
//                 foreach ($target as $k => $t) {
//                     if ($k === 0) {
//                         continue;
//                     }
//                     if (array_key_exists($t, $file)) {
//                         $file = $file[$t];
//                     }
//                 }
//             }
//             $file = [
//                         'json' => json_encode($file),
//                         'array' => $file,
//                         'object' => (object) $file
//                     ][$cast ?? 'json'] ?? json_encode($file);
//             return $file;
//         } catch (Exception $e) {
//             return null;
//         }
//     }
// }
// if (! function_exists('allowed')) {
//     /**
//      * @param string $socialId
//      * @param mixed $tickets
//      * @return bool
//      */
//     function allowed(string $socialId, $tickets) : bool
//     {
//         return App\Services\API\KerberosApiService::has($socialId, $tickets);
//     }
// }
// if (! function_exists('is_filled')) {
//     /**
//      * @param mixed $arg
//      * @return bool
//      */
//     function is_filled($arg) : bool
//     {
//         if (is_object($arg) || is_array($arg)) {
//             return (bool) count([
//                                     'object' => (array) $arg,
//                                     'array' => $arg
//                                 ][gettype($arg)] ?? 0);
//         }
//         return (bool) $arg;
//     }
// }
if (! function_exists('array_switch')) {
    /**
     * @param array $conditions
     * @param mixed $key
     * @return mixed
     */
    function array_switch(array $conditions, $key)
    {
        foreach ($conditions as $k => $v) {
            if ($key === $k) {
                return $v;
            }
        }
        return null;
    }
}
if (! function_exists('paginate')) {
    function paginate(Collection $items, int $total, int $perPage = 15, int $page = 1, array $options = []): LengthAwarePaginator
    {
        return new LengthAwarePaginator($items, $total, $perPage, $page, $options);
    }
}
// if (! function_exists('login')) {
//     /**
//      * @return object
//      */
//     function login() : object
//     {
//         return app(App\Services\API\MuApiService::class)->login();
//     }
// }
// if (! function_exists('is_logged')) {
//     /**
//      * @param string $token
//      * @return bool
//      */
//     function is_logged(string $token) : bool
//     {
//         return app(App\Services\API\MuApiService::class)->isLogged($token);
//     }
// }
// if (! function_exists('get_user')) {
//     /**
//      * @param string $token
//      * @return bool
//      */
//     function get_user(string $token) : array
//     {
//         if (! is_logged($token)) {
//             throw new \Exception("Invalid Access Token.", 401);
//         }
//         return app(App\Services\API\MuApiService::class)->show($token);
//     }
// }
