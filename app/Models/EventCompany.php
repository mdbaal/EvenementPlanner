<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EventCompany extends Model
{
    //
    protected $guarded = [];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function users(): HasMany{
        return $this->hasMany(User::class);
    }
}
