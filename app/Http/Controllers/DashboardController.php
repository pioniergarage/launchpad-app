<?php

namespace App\Http\Controllers;

use App\Services\Slack;
use App\SlackUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $ranking = DB::select(DB::raw('SELECT receiver_id AS username, COUNT(*) AS score FROM slack_props GROUP BY receiver_id'));

        return view('welcome', ['ranking' => $ranking]);
    }

    public function userDetail($username)
    {
        $user = SlackUser::find($username);
        return view('users.view', compact('user'));
    }

    public function slackTest()
    {
        Slack::importProps();
    }
}