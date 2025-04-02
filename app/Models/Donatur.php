<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donatur extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'anonim',
        'name_show',
        'payment_status',
        'payment_method',
        'notes',
        'donation_id',
        'proof',
        'proof_public_id',
        'total_amount',
        'is_paid',
        'proof',
        'email',
    ];

    public function donation(){
        return $this->belongsTo(Donation::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
