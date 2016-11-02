<?php

namespace App\Http\Controllers;

use App\Services\Ranking;
use App\Services\Slack;
use App\SlackUser;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $ranking = Ranking::getRanking();

        return view('welcome', ['ranking' => $ranking]);
    }

    public function userDetail($username)
    {
        $user = SlackUser::find($username);
        return view('users.view', compact('user'));
    }

    public function slack()
    {
        Slack::importProps();
        Slack::sendRanking();

        return redirect()->back();
    }
}