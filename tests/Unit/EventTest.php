<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     *
     */
    public function testList()
    {
        $this->json('POST', '/api/v1/bookmystand')
            ->assertJson([
                'error' => false,
                'message' => 'All events fetched'
            ]);
    }

    /**
     * test to fetch all stands for a event
     */
    public function testStandsOfEvent()
    {
        $this->json('POST', '/api/v1/bookmystand/getallstands', ['event_id' => 1])
            ->assertJson([
                'error' => false,
                'message' => 'All stands fetched for this event'
            ]);
    }

    /**
     * get event details
     */
    public function testGetEventDetails()
    {
        $this->json('POST', '/api/v1/bookmystand/geteventdetails', ['id' => 1])
            ->assertJson([
                'error' => false,
                'message' => 'Event details fetched'
            ]);
    }

    /**
     * reserve a stand
     */
    public function testReserveStand()
    {
        $this->json('POST', '/api/v1/bookmystand/reservestand', ["company_name" => "good company","admin" => "good admin","admin_email" => "goodadmin@good.com","phone" => "461333","add1" => "good add1","add2" => "good add2","zip" => "64613", "stand_id" => "2"])
            ->assertJson([
                'error' => false,
                'message' => 'Reserved stand successfully'
            ]);
    }
}
