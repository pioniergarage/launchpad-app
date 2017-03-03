<?php

namespace App\Http\Controllers;

use Mail;


class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.view');
    }

    public function  submitForm($data){
        Mail::send('mails.reservation', $data, function($message) {
            $message->from('LaunchpadApp@pioniergarage.de', 'Launchpad App')->to(env('MAIL_RECIPIENT'))->subject('[Rerservation Request]');
        });

    }
}