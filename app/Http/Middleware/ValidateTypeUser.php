<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponser;
use Closure;
use Illuminate\Http\Request;

class ValidateTypeUser
{
    use ApiResponser;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $userTypes)
    {
        if (!in_array($request->user()->type->name, explode('|', $userTypes))) {
            return $this->errorResponse('This user is not of type: ' . $userTypes, 403);
        }
        return $next($request);
    }
}
