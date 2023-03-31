<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Subscription extends Model
{
    use HasFactory;

    public function channel(){
        return $this->belongsTo(Channel::class,'channel_id');
    }
}
