<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bulletin extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug', 
        'publisher',
        'file',
        'file_public_id',
    ];
    
    public function GetRouteKeyName() {
        return 'slug';
    }


}
