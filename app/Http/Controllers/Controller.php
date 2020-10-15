<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected Model $model;
}
