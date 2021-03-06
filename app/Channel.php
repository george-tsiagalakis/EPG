<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $casts = ['id' => 'string'];

    public function programmes()
    {
        return $this->belongsTo('App\Programme', 'timetables');
    }

    public function timetables()
    {
        return $this->belongsTo('App\Timetable');
    }
}
