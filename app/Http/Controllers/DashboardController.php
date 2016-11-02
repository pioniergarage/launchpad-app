<?php

namespace App\Http\Controllers;

use App\Services\Ranking;
use App\Services\Slack;
use App\SlackProp;
use App\SlackUser;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $ranking = Ranking::getRanking();
        $props = SlackProp::query()->orderBy('created_at', 'DESC')->take(5)->get();

        return view('welcome', compact('ranking', 'props'));
    }

    public function userDetail($username)
    {
        $user = SlackUser::find($username);
        return view('users.view', compact('user'));
    }

    public function slack()
    {
        $newestBeforeUpdate = SlackProp::query()->orderBy('created_at', 'DESC')->value('created_at');
        Slack::importProps();
        $newestAfterUpdate = SlackProp::query()->orderBy('created_at', 'DESC')->value('created_at');

        if ($newestAfterUpdate->gt($newestBeforeUpdate)) {
            Slack::sendRanking();
        }

        return redirect()->back();
    }
}