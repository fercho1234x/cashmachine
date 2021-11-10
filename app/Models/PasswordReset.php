<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'email', 'token', 'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'token'
    ];

    /**
     * Generate verification token
     *
     *
     */
    static public function generateVerificationToken()
    {
        return bin2hex(random_bytes(80));
    }
}
