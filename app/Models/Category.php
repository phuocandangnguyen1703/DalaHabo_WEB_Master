<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'active',
    ];

    public function places() {
        return $this->hasMany(Place::class);
    }

    public function scopeSearch($query) {
        if($keyword = request()->keyword) {
            $query = $query->where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }
}
