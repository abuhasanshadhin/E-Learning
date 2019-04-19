<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonViews extends Model
{
    protected $fillable = ['lesson_id', 'ip_address'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
