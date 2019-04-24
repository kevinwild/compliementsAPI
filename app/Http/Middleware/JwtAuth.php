<?php

namespace App\Http\Middleware;

use Closure;
use ReallySimpleJWT\Token;


class JwtAuth
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance and set JWT from .env
     *
     * @return void
     */
    public function __construct()
    {
        $this->secret = env('JWT_TOKEN');
    }

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
        $token = $request->input("token");

        if (!Token::validate($token, $this->secret)) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
