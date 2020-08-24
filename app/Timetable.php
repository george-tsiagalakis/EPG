<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Timetable extends Model
{
	protected $hidden = ['created_at', 'updated_at'];
    protected $casts = ['id' => 'string'];

    public function channels()
    {
        return $this->belongsTo('App\Channel', 'channel_id');
    }

    public function programmes()
    {
        return $this->belongsTo('App\Programme', 'programme_id');
    }

    public function scopeChannel($query, $channel_id)
    {
       return $query->where('channel_id', '=', $channel_id);
    }

    public function scopeProgramme($query, $programme_id)
    {
       return $query->where('programme_id', '=', $programme_id);
    }

    public function scopeDate($query, $date)
    {
       return $query->where('start_time', '>=', $date);
    }

    public function scopeTimezone($query, $timezone)
    {
       return $query->where('timezone', '=', $timezone);
    }

}
