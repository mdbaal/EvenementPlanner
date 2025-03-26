<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    //
    protected $guarded = [
        "id",
        "registered_people",
        "company_id",
        "edit_lock"
    ];



    public function company(): BelongsTo{
        return $this->belongsTo(EventCompany::class);
    }
}
