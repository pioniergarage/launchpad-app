<?php

namespace App\Http\Controllers;


class CalendarController extends Controller
{
    public function index()
    {   
        return view('calendar.view');
    }
}