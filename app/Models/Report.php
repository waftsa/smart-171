<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    //
    use HasFactory, SoftDeletes; 

    protected $fillable = [
        'name', 
        'slug', 
        'code',
        'file_path',
        'token',
    ];

    
}
