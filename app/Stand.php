<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    protected $table = 'stands';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|string
     */
    public function company()
    {
        try {
            return $this->hasOne('App\Company', 'id', 'company_id');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /*
     * relationship
     */
    public function event()
    {
        try {
            return $this->hasOne('App\Event', 'id', 'event_id');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $eventId
     * @return array
     */
    public function getAllStands($eventId)
    {
        try {
            $allStands = Stand::with('event', 'company')
                ->where('event_id', $eventId)
                ->get()
                ->toArray(); 
            return $allStands;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * to fetch all stands of all events
     * @return array|string
     */
    public function getAllStandsOfAllEvents()
    {
        try {
            $allStands = Stand::with('event', 'company')
                ->get()
                ->toArray();
            return $allStands;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $param
     * @return bool|string
     */
    public function reserveStand($param)
    {
        try {
            if($param) {

                $affectedRow = Stand::where('id', '=', $param['standId'])
                    ->update(array(
                        'company_id' => $param['companyId'],
                        'booked' => 1,
                        'booked_time' => date('Y-m-d H:i:s')
                    ));

                return $affectedRow;
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * to get stand details along with user
     * @return array
     */
    public function getStandBookingDetails()
    {
        try {
            $standDetails = $this->with('company')
                ->toArray();
            return $standDetails;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
