<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Traits\ApiResponser;

class RegisterController extends Controller
{
    use ApiResponser;

    /**
     *
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $fields = $request->validated();
        $fields['verification_token'] = User::generateVerificationToken();
        $user = User::create($fields);
        $user->assignRole('cliente');
        return $this->showOne($user);
    }
}
