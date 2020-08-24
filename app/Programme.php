<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $hidden = ['pivot', 'created_at', 'updated_at'];
    protected $casts = ['id' => 'string'];

    public function channels()
    {
        return $this->belongsTo('App\Channel', 'timetables');
    }

    public function timetables()
    {
        return $this->hasMany('App\Timetable');
    }
}
