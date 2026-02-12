<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    //
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        'title', 
        'slug', 
        'summary',
        'content',
        'cover',
        'cover_public_id',
        'status',
        'slider',
        'user_id',
        'category_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class)->where('type', 'articles');
    }

    public function getCoverUrlAttribute()
    {
        // Kalau kosong
        if (! $this->cover) {
            return asset('images/placeholder.jpg');
        }

        // Kalau sudah URL (Cloudinary, dll)
        if (str_starts_with($this->cover, 'http')) {
            return $this->cover;
        }

        // Kalau local storage
        return Storage::url($this->cover);
    }
}
