<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\Authenticate; // Add this import

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'role' => \App\Http\Middleware\CheckRole::class,
        'admin' => \App\Http\Middleware\IsAdmin::class,
    ];
}
