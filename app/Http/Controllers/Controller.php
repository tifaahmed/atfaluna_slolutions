<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\ControllerTraits\ResponsesTrait;
use App\Http\Controllers\ControllerTraits\FileTrait;
use App\Http\Controllers\ControllerTraits\LanguageTrait;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
    use AuthorizesRequests , ResponsesTrait ,FileTrait ,LanguageTrait;
}
