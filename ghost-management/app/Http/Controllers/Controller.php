<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests;
    
//AuthorizesRequests is a trait that is used to authorize requests
// The authorizeResource method automatically maps:
// index() → viewAny() policy method
// show() → view() policy method
// create() → create() policy method
// store() → create() policy method
// edit() → update() policy method
// update() → update() policy method
// destroy() → delete() policy method
}
