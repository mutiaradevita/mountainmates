<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
        if ($request->is('admin') || $request->is('admin/*')) {
            return route('admin.login');
        }

        if ($request->is('organizer') || $request->is('organizer/*')) {
            return route('organizer.login');
        }

        // default: user/peserta
        return route('login'); 
        }

        return null;
    }
}
