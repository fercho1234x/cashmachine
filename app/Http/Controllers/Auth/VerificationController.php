<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponser;

class VerificationController extends Controller
{
    use ApiResponser;

    /**
     * Mark the authenticated user's email address as verified.
     *
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();
        return $this->showOne($user);
    }

    /**
     * Resend the email verification notification.
     *
     */
    public function resend()
    {
        return auth()->user;
    }
}
