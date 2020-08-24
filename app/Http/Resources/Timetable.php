<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Programme as ProgrammeResource;
use App\Programme;

class Timetable extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $start    = new \DateTime($this->start_time);
        $end      = new \DateTime($this->end_time);
        $duration = $end->getTimestamp() - $start->getTimestamp();

        $programme = $this->programmes()->get()->toArray()[0];
        $channel   = $this->channels()->get()->toArray()[0];

        $route = strstr(\Route::currentRouteName(), '_programme_information') ? 'info' : 'timetable';

        switch ($route) {

           case 'info':

                $data = [
                    'uuid'        => $programme['id'],
                    'name'        => $programme['name'],
                    'description' => $programme['description'],
                    'thumbnail'   => $programme['thumbnail'],
                    'start_time'  => $this->start_time,
                    'end_time'    => $this->end_time,
                    'duration'    => $duration,
                    'channel'     => $channel,
                ];
                break;

           case 'timetable':

                $data = [
                    'uuid'        => $this->id,
                    'name'        => $programme['name'],
                    'start_time'  => $this->start_time,
                    'end_time'    => $this->end_time,
                    'duration'    => $duration,
                ];
                break;
        }

        return $data;
    }
}
