<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // mock role
        if (Auth::check() && Auth::user()->role === RoleEnum::ADMIN->value) {
            return $next($request);
        }

        abort(403);
    }
}
