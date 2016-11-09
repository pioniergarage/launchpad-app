<?php

namespace App\Http\Controllers;

use App\Services\Ranking;
use App\Services\Slack;
use App\SlackProp;
use App\SlackUser;

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

    public function userDetail($username)
    {
        $user = SlackUser::find($username);
        $scoreboard  = $user->getReceivedPropsPerMonth();

        $propsReceived = $user->receivedProps()
            ->orderBy('created_at', 'DESC')
            ->take(10)
            ->get();

        $propsGiven = $user->givenProps()
            ->orderBy('created_at', 'DESC')
            ->take(10)
            ->get();

        return view('users.view', compact('user', 'propsReceived', 'propsGiven','scoreboard'));
    }

    public function slack()
    {
        Slack::beGrowbot();
        return redirect()->back();
    }
}