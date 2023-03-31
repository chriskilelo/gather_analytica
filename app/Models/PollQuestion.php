<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollQuestion extends Model
{
    use HasFactory;

    // [RELATIONSHIP] A PollQuestion has many PollAnswers
    public function pollAnswers()
    {
        return $this->hasMany(PollAnswer::class);
    }

    // [RELATIONSHIP] A Poll Question belongs to a Poll
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

}