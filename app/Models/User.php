<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_type_id',
        'name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Return if user is verified
     *
     *
     */
    public function isVerified()
    {
        return $this->email_verified_at ? true : false;
    }

    /**
     * Generate verification token
     *
     *
     */
    public static function generateVerificationToken()
    {
        return bin2hex(random_bytes(40));
    }

    /**
     * Mutators
     *
     */
    public function setNameAttribute($name) {
        $this->attributes['name'] = mb_strtolower($name);
    }

    public function setLastNameAttribute($last_name) {
        $this->attributes['last_name'] = mb_strtolower($last_name);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Relationships
     *
     */
    public function type()
    {
        return $this->belongsTo(TypeUser::class, 'user_type_id');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class, 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
