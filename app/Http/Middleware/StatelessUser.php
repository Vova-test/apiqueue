<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\UserService;

class StatelessUser
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function handle($request, Closure $next)
    {
        $email = $request->headers->get('email');
        $password = $request->headers->get('password');

        $user = $this->userService->getUser($email, $password);

        if (!$user) {
           return response()->json(['result' => false]);
        }
        return $next($request->merge(['user' => $user]));
    }
}
