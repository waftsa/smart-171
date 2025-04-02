<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documentation extends Model
{
    //
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        'title', 
        'slug', 
        'category_id', 
        'caption',
        'content',
        'youtube',
        'status',
        'slider',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class)->where('type', 'documentations');
    }
}
