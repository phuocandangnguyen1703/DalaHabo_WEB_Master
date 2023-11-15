<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'role_id',
        'token',
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

    public function role() {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if the user has a role
     * @param string $role
     * @return bool
     */
    public function hasRole($role) {
        return null !== $this->role()->where('name', $role)->first();
    }

    public function scopeSearch($query) {
        if($keyword = request()->keyword) {
            $query = $query->where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }

    // public function getImageAttribute($query) {
    //     if($query) {
    //         return asset($query);
    //     }
    // }
}
