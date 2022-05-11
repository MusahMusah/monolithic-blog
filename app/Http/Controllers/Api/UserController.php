<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display User information.
     */
    public function __invoke()
    {
        return response()->success(
            auth()->user(),
            'User Information retrieved successfully.'
        );
    }
}
