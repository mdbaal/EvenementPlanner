<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EventCompany extends Model
{
    //


    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function managers(): HasMany
    {
        return $this->hasMany(EventManager::class);
    }
}
