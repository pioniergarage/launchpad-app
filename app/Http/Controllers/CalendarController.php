<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use Mail;


class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.view');
    }

    public function  submitForm(){
        Mail::send('mails.reservation', function($message) {
            $message->from('LaunchpadApp@pioniergarage.de', 'Launchpad App')->to(env('MAIL_RECIPIENT'))->subject('[Rerservation Request]');
        });

    }

    public function testFunction(){

        $data = array('Name' => '',
                    'Raum' => '',
                    'Datum' => '',
                    'Von' => '',
                    'Bis' => '',
                    'Anmerkungen' => '');

        return dd($data);

    }
}