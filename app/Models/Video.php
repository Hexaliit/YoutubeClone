<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Video extends Model
{
    use HasFactory;
    public function channel(){
        return $this->belongsTo(Channel::class,'channel_id');
    }
    public function votes(){
        return $this->morphMany(Vote::class , 'voteable');
    }
    public function comments(){
        return $this->hasMany(Comment::class)->whereNull('comment_id')->orderBy('created_at','DESC');
    }
}
