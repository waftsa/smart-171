<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'category_id',
        'thumbnail',
        'thumbnail_public_id',
        'thumbnail_text',
        'about',
        'code',
        'has_finished',
        'is_active',
        'slider',
        'target_amount',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function donaturs(){
        return $this->hasMany(Donatur::class)->where('payment_status', 'success');
    }
    
    public function totalReachedAmount(){
        return $this->donaturs()->sum('total_amount');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
