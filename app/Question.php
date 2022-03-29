<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'topic_id',
        'question',
        'a',
        'b',
        'c',
        'd',
        'answer',
        'code_snippet',
        'answer_exp',
        'question_img',
        'question_video_link'
    ];

    public function answers() {
        return $this->hasOne(Answer::class);
    }

    public function topic() {
        return $this->belongsTo(Topic::class);
    }
}
