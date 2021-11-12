<?php

namespace App\Http\Middleware;

use App\Models\Account;
use App\Traits\ApiResponser;
use Closure;
use Illuminate\Http\Request;

class ValidateAccountType
{
    use ApiResponser;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $typeAccount)
    {
        if ($request->account->type->name != $typeAccount) {
            return $this->errorResponse('This account is not of type: ' . $typeAccount, 403);
        }

        return $next($request);
    }
}
