<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $append = [
        'cover_url'
    ];

    protected function getCoverUrlAttribute()
    {
        $cover = $this->cover;
        if(!str_contains($cover, 'http')){
            return asset('storage/'.$cover);
        }

        return $cover;
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'book_category',
            'book_id',
            'category_id')->withPivot(['updated_at']);
    }
}
