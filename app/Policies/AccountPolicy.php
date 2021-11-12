<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function addFoundsDebitAccount(User $user, Account $account) {
        return $user->id === $account->user_id;
    }

    public function withdrawFoundsDebitAccount(User $user, Account $account) {
        return $user->id === $account->user_id;
    }

    public function withdrawFoundsCreditAccount(User $user, Account $account) {
        return $user->id === $account->user_id;
    }

    public function payTheCreditCard(User $user, Account $account) {
        return $user->id === $account->user_id;
    }
}
