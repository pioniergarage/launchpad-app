<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $ranking = Session::get('ranking', []);

        return view('welcome', ['ranking' => $ranking]);
    }

    public function postMessage(Request $request)
    {
        $plaintext = $request->input('message');

        preg_match_all('/\@[A-z]* `[0-9]+`/', $plaintext, $matches);
        //dd($matches);

        $ranking = [];
        foreach ($matches[0] as $match) {
            preg_match('/\@[A-z]*/', $match, $name);

            preg_match('`[0-9]+`', $match, $score);

            $ranking[] = [
                'name' => $name[0],
                'score' => $score[0],
            ];
        }

        Session::put('ranking', $ranking);

        return redirect('/');
    }
}