<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();

        // If the user is not authenticated, redirect them to the login page
        if (!$user) {
            return redirect('login')->withErrors('You must be logged in to access this page');
        }

        // Check if the user's role is 'admin'
        if ($user->role === 'admin') {
            // If the user is an admin, proceed with the request
            return $next($request);
        } else {
            // If the user is not an admin, redirect them with an error message
            return redirect('home')->withErrors('You do not have admin access');
        }
    }
}
