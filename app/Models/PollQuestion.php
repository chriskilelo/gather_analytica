<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PollQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function scopeOrderByDateModified($query)
    {
        $query->orderBy('updated_at')->orderBy('created_at');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('question', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhereHas('poll', function ($query) use ($search) {
                        $query->where('title', 'like', '%'.$search.'%');
                    });
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

}
