<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourguide extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'gender',
        'email',
        'phone',
        'short_description',
        'description',
        'rental_price',
    ];

    public function scopeSearch($query) {
        if($keyword = request()->keyword) {
            $query = $query->where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }
}
