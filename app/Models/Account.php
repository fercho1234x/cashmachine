<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    const CREDIT = 'credito';
    const DEBIT = 'debito';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'account_type_id',
        'user_id',
        'card_number',
        'name',
        'description',
        'balance'
    ];

    /**
     * Relationships
     *
     */
    public function type()
    {
        return $this->belongsTo(AccountType::class, 'account_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * DB Queries
     *
     */
    public function totalAmountDepositsCurrentMonth()
    {
        return $this->transactions()
            ->whereBetween('created_at', [now()->startOfMonth(), now()])
            ->where('type', Transaction::TYPE_INCOME)
            ->sum('amount_of_transaction');
    }
}
