<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    protected $fillable=["event_id","name","description	","user_id"];
}
