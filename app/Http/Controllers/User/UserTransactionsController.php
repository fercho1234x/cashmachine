<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Requests\DepositRequest;
use App\Models\Account;
use App\Models\Transaction;

class UserTransactionsController extends ApiController

{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = auth()->user();
    }

    public function addFoundsDebitAccount(DepositRequest $request, Account $account)
    {
        $totalAmountDepositAvailable = $this->user->getMaxMonthlyDeposits() - $account->totalAmountDepositsCurrentMonth();
        if ($request->amount_of_transaction > $totalAmountDepositAvailable) {
            return $this->errorResponse('Amount of monthly deposits exceeded', 403);
        }

        $account->update(['balance' => ($account->balance + $request->amount_of_transaction)]);

        $transaction = array_merge($request->validated(), [
            'user_id'    => $this->user->id,
            'type'       => Transaction::TYPE_INCOME
        ]);

        $account->transactions()->create($transaction);

        return $this->showOne($account);
    }

    public function withdrawFoundsDebitAccount(DepositRequest $request, Account $account) {
        if ($account->balance < $request->amount_of_transaction) {
            return $this->errorResponse('Insufficient funds', 403);
        }

        $account->update(['balance' => ($account->balance - $request->amount_of_transaction)]);

        $transaction = array_merge($request->validated(), [
            'user_id'    => $this->user->id,
            'type'       => Transaction::TYPE_EXPENSE
        ]);

        $account->transactions()->create($transaction);

        return $this->showOne($account);
    }

    public function withdrawFoundsCreditAccount(DepositRequest $request, Account $account) {
        $commission = ($account->type->cash_disposition_commission
                            ? $account->type->cash_disposition_commission
                            : Transaction::CASH_WITHDRAWAL_COMMISSION) / 100;

        $balance = $this->user->type->credit_limit - $account->balance;

        $newBalance = $balance - $request->amount_of_transaction * $commission;
        $newBalanceWithCommission = $newBalance - $request->amount_of_transaction;

        if ($newBalanceWithCommission <= 0) {
            return $this->errorResponse('Insufficient funds', 403);
        }

        $account->update(['balance' => $account->balance + $request->amount_of_transaction * (1 + $commission)]);

        $account->transactions()->create([
            'user_id' => $this->user->id,
            'amount_of_transaction' => $request->amount_of_transaction * (1 + $commission),
            'details' => $request->details,
            'type' => Transaction::TYPE_EXPENSE
        ]);

        return $this->showOne($account);
    }

    public function payTheCreditCard(DepositRequest $request, Account $account) {

        if ($request->amount_of_transaction > $account->balance) {
            return $this->errorResponse('The transaction amount exceeds the limit', 403);
        }

        $account->update(['balance' => ($account->balance - $request->amount_of_transaction)]);

        $transaction = array_merge($request->validated(), [
            'user_id'    => $this->user->id,
            'type'       => Transaction::TYPE_INCOME
        ]);

        $account->transactions()->create($transaction);

        return $this->showOne($account);
    }
}
