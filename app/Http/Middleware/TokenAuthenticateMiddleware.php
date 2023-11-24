<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helper\JWTToken;

class TokenAuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookie('token');
        $result = JWTToken::ReadToken($token);
        if($result=='unauthorized'){
            return redirect('/UserLogin');
        }else{
            $request->headers->set('email', $result->UserEmail);
            $request->headers->set('id', $result->userID);
            return $next($request);
        }
        
    }
}
