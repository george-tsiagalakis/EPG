<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
	protected $hidden = ['pivot', 'created_at', 'updated_at'];
    protected $casts = ['id' => 'string'];

    public function channels()
    {
       return $this->hasOneThrough('App\Timetable');
    }

    public function timetables()
    {
       return $this->belongsTo('App\Timetable');
    }
}
