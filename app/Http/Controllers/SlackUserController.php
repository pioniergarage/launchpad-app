<?php

namespace App\Http\Controllers;


use App\SlackUser;

class SlackUserController extends Controller
{
    public function show(SlackUser $user)
    {
        $scoreboard  = $user->getReceivedPropsPerWeek();

        $propsReceived = $user->receivedProps()
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        $propsGiven = $user->givenProps()
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        return view('users.view', compact('user', 'propsReceived', 'propsGiven','scoreboard'));
    }
}