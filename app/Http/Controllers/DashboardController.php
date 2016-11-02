<?php

namespace App\Http\Controllers;

use App\Services\Slack;
use App\SlackUser;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $query = 'SELECT receiver_id AS username, COUNT(*) AS score FROM slack_props GROUP BY receiver_id';
        $ranking = DB::select(DB::raw($query));

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
        return redirect()->back();
    }
}