<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'icon',
        'icon_public_id',
    ];

    public function donations(){
        return $this->hasMany(Donation::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function documentations(){
        return $this->hasMany(Documentation::class);
    }
}

