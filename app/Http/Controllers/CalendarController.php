<?php

namespace App\Http\Controllers;

use Mail;
use App\Http\Requests\ReservationFormRequest;
use phpDocumentor\Reflection\Types\Array_;


class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.view');
    }

    public function  submitForm(ReservationFormRequest $request){
        $data = array('Name' => $request->get('name'),
            'Mail' => $request->get('mail'),
            'Raum' => $request->get('choiceOfSpace'),
            'Datum' => $request->get('reservationdate'),
            'Von' => $request->get('startingtime'),
            'Bis' => $request->get('endtime'),
            'Anmerkungen' => $request->get('additional-information'));

        //$this->sendReservationMail($data);

        return dd($data);


        //return \Redirect::route('reservation')
        //    ->with('message', 'Thanks for contacting us!');


    }

    public function sendReservationMail($data){
        Mail::send('mails.reservation', $data ,function($message) {
            $message->from('LaunchpadApp@pioniergarage.de', 'Launchpad App')->to(env('MAIL_RECIPIENT'))->subject('[Rerservation Request]');
        });
    }
}