<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
        if ($request->is('admin') || $request->is('admin/*')) {
            return route('login');
        }

        if ($request->is('pengelola') || $request->is('pengelola/*')) {
            return route('login');
        }

        return route('login'); 
        }

        return null;
    }
}
