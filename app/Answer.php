<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'topic_id', 'user_id', 'question_id', 'user_answer', 'answer'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function topic() {
        return $this->belongsTo(Topic::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
