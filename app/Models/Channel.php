<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Channel extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
    public function videos(){
        return $this->hasMany(Video::class);
    }
}
