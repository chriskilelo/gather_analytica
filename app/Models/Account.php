<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function polls()
    {
        return $this->hasMany(Poll::class);
    }

    public function pollAnswers()
    {
        return $this->hasMany(PollAnswer::class);
    }
}
