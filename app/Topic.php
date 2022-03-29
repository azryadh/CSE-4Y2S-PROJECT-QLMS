<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function question(){
        return $this->hasOne(Question::class);
    }

    public function answer(){
        return $this->hasOne(Answer::class);
    }

    public function user() {
        return $this->belongsToMany(User::class,'topic_user')
            ->withPivot('amount','transaction_id', 'status')
            ->withTimestamps();
    }
}
