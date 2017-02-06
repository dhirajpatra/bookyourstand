<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Event;
use App\Stand;
use App\Company;
use Mail;

class EventapiController extends Controller
{
    /**
     * fetch all events
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        try {
            // model obj
            $eventObj = new Event();
            $events = $eventObj->getAllEvents();

            $statusCode = 200;
            return response(array(
                'error' => false,
                'message' => 'All events fetched',
                'events' => $events,
            ), $statusCode);

        } catch (\Exception $e){

            $statusCode = $e->getCode();
            return response(array(
                'error' => true,
                'message' => $e->getMessage(),
            ), $statusCode);

        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getEventDetails(Request $request)
    {
        try {
            $id = $request->input('id');
            $eventObj = new Event();
            $eventDetails = $eventObj->getEventDetails($id);

            $statusCode = 200;
            return response(array(
                'error' => false,
                'message' => 'Event details fetched',
                'event' => $eventDetails,
            ), $statusCode);

        } catch (\Exception $e){

            $statusCode = $e->getCode();
            return response(array(
                'error' => true,
                'message' => $e->getMessage(),
            ), $statusCode);

        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getAllStandsOfEvent(Request $request)
    {
        try {
            $eventId = $request->input('event_id');
            $standObj = new Stand();
            $allStands = $standObj->getAllStands($eventId);

            $companyObj = new Company();

            $i = 0;
            foreach ($allStands as $stand) {
                //print_r($stand); exit;
                if ($stand['free'] == 1) {
                    $allStands[$i]['freestand'] = 'Free';
                } else {
                    $allStands[$i]['freestand'] = '';
                }

                if ($stand['booked'] == 1) {
                    $allStands[$i]['class'] = 'booked';
                    // need company details
                    $companyDetails = $companyObj->getCompanyDetails($stand['company_id']);

                    $allStands[$i]['company_details'] = $companyDetails[0];
                    $allStands[$i]['company_details']['logo'] = url('/uploads/company/logo/' .$companyDetails[0]['logo']);
                    $allStands[$i]['company_details']['document'] = $companyDetails[0]['document'];
                }else{
                    $allStands[$i]['class'] = '';
                    $allStands[$i]['company_details'] = array(
                        'logo' => '',
                        'document' => ''
                    );
                }

                $i++;
            }

            $statusCode = 200;
            return response(array(
                'error' => false,
                'message' => 'All stands fetched for this event',
                'stands' => $allStands,
            ), $statusCode);

        } catch (\Exception $e){

            $statusCode = $e->getCode();
            return response(array(
                'error' => true,
                'message' => $e->getMessage(),
            ), $statusCode);

        }
    }

     /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function reserveStand(Request $request)
    {
        try {
            $companyId = $request->input('company_id');
            $standId = $request->input('stand_id');

            $standObj = new Stand();
            $result = $standObj->reserveStand(array(
               'companyId' => $companyId,
                'standId' => $standId
            ));

            if(is_numeric($result) &&  $result > 0){
                $statusCode = 200;
                return response(array(
                    'error' => false,
                    'message' =>'Reserved stand successfully',
                ), $statusCode);

            }else{
                $statusCode = 400;
                return response(array(
                    'error' => true,
                    'message' =>'Reserved stand save error',
                ), $statusCode);

            }

        } catch (\Exception $e){

            $statusCode = $e->getCode();
            return response(array(
                'error' => true,
                'message' => $e->getMessage(),
            ), $statusCode);

        }
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function sendReportToAdmin()
    {
        try {
            $stand = new Stand();
            $detailsReport = $stand->getAllStandsOfAllEvents();

            // send mail to admin
            Mail::send('emails.report', ['report' => $detailsReport], function ($m) use ($detailsReport) {
                $m->from('hello@app.com', 'All stands report');

                $m->to('admin email', 'admin')->subject('All stands details report!');
            });

        } catch (\Exception $e){

            $statusCode = $e->getCode();
            return response(array(
                'error' => true,
                'message' => $e->getMessage(),
            ), $statusCode);

        }
    }
}
