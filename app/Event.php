<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        try {
            return $this->hasOne('App\Location', 'id', 'location_id');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * This will return all event along with their location
     * @return array
     */
    public function getAllEvents()
    {
        try {
            $eventList = Event::with('location')
                    ->whereRaw("DATE(whenat) > '".date('Y-m-d')." 00:00:00'")
                    ->get()
                    ->toArray();
            return $eventList;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEventDetails($id)
    {
        try {
            $eventDetails = Event::where('id', $id)
                ->get();
            return $eventDetails;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
