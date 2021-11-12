<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Traits\ApiResponser;

class TransactionsController extends Controller
{
    use ApiResponser;

    public function newTransactionDebitAccount(TransactionRequest $request)
    {
        $account = $request->account;

        if ($account->balance < $request->amount_of_transaction) {
            return $this->errorResponse('Insufficient funds', 403);
        }

        $account->update(['balance' => ($account->balance - $request->amount_of_transaction)]);

        $data = array_merge($request->validated(), [
            'user_id'    => $account->user_id,
            'type'       => Transaction::TYPE_EXPENSE
        ]);

        $transaction = $account->transactions()->create($data);

        return $this->showOne($transaction);
    }

    public function newTransactionCreditAccount(TransactionRequest $request)
    {
        $account = $request->account;

        $newBalance = $account->balance + $request->amount_of_transaction;

        if ($newBalance > $account->user->type->credit_limit) {
            return $this->errorResponse('Insufficient credit limit', 403);
        }

        $account->update(['balance' => $newBalance]);

        $data = array_merge($request->validated(), [
            'user_id'    => $account->user_id,
            'type'       => Transaction::TYPE_EXPENSE
        ]);

        $transaction = $account->transactions()->create($data);

        return $this->showOne($transaction);
    }
}
