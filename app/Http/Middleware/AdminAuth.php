<?php

namespace App\Http\Middleware;

use App\User;
use Closure;


class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->route("token");
        $user = User::where("token", "=", $token)->first();
        if ($user == null) {
            return view('login');
        }
        $request->request->add(['user' => $user]); //add user to request
        return $next($request);
    }
}
