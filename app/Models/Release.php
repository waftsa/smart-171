<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Release extends Model
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
        return $this->belongsTo(Category::class)->where('type', 'releases');
    }
}
