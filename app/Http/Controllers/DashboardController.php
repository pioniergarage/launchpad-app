<?php

namespace App\Http\Controllers;

use App\Services\Ranking;
use App\Services\Slack;
use App\SlackProp;

class DashboardController extends Controller
{
    public function index()
    {
        $ranking = Ranking::getRanking();

        $props = SlackProp::query()
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        return view('welcome', compact('ranking', 'props'));
    }

    public function slack()
    {
        Slack::beGrowbot();
        return redirect()->back();
    }
}