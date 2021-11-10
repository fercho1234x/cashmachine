<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    use HasFactory;

    protected $table = 'types_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'max_monthly_deposits',
        'credit_limit'
    ];

    /**
     * Relationships
     *
     */
    public function users()
    {
        return $this->hasMany(User::class, 'user_type_id');
    }

}
