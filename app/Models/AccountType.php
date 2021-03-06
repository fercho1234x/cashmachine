<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'cash_disposition_commission'
    ];

    /**
     * Relationships
     *
     */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
