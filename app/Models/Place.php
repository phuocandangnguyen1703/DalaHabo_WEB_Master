<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'address',
        'location',
        'summary',
        'description',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function images() {
        return $this->hasMany(PlaceImages::class);
    }
   
    public function scopeSearch($query) {
        if($keyword = request()->keyword) {
            $query = $query->where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }
}
