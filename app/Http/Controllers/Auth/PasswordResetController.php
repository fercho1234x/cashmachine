<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\PasswordResetConfirmationMessage;
use App\Models\PasswordReset;
use App\Models\User;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    use ApiResponser;

    public function sendEmailToken()
    {
        request()->validate([
            'email' => ['required', 'email']
        ]);

        User::where('email', request('email'))->firstOrFail();
        PasswordReset::where( 'email', request('email') )->delete();
        $fields = request()->all();
        $fields['token'] = PasswordReset::generateVerificationToken();
        $fields['created_at'] = now();
        $passwordReset = PasswordReset::create($fields);
        return $this->showOne($passwordReset);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $emailToken = PasswordReset::where([
            'email' => request('email'),
            'token' => request('token'),
        ])->firstOrFail();

        $dateCreated = Carbon::parse($emailToken->created_at);

        if ($dateCreated->diffInMinutes() > 60) {
            $emailToken->delete();
            $fields = request()->all();
            $fields['token'] = PasswordReset::generateVerificationToken();
            $fields['expires_at'] = now()->addHours(1);
            PasswordReset::create($fields);
            return $this->errorResponse('Expired token, token forwarded', 400);
        }

        $user = User::where('email', request('email'))->firstOrFail();
        $user->update(['password' => request('password')]);
        $emailToken->delete();
        Mail::to($user)->queue(new PasswordResetConfirmationMessage($user));
        return  $this->showMessage('Password successfully changed');
    }
}
