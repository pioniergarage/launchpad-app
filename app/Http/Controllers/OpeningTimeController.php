<?php

namespace App\Http\Controllers;


use App\OpeningTime;

class OpeningTimeController extends Controller
{
    public function index()
    {
        $openingTimes = OpeningTime::query()
            ->orderBy('open_at', 'DESC')
            ->get()
            ->groupBy(function ($ot) {return $ot->open_at->toDateString();});

        return view('opening-times.index', compact('openingTimes'));
    }
}