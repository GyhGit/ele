<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=["title","content","start_time","end_time","prize_time","num","is_prize"];

    //通过活动找报名人
    public function users()
    {
        return $this->belongsToMany(User::class, 'event_users', 'event_id', 'user_id');
    }

}
