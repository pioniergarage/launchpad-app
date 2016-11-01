<?php

namespace App\Http\Controllers;

use App\Ranking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ranking = Ranking::all();

        return view('welcome', ['ranking' => $ranking]);
    }

    public function postMessage(Request $request)
    {
        $plaintext = $request->input('message');

        preg_match_all('/\@[A-z]* `[0-9]+`/', $plaintext, $matches);

        foreach ($matches[0] as $match) {
            preg_match('/\@[A-z]*/', $match, $name);

            preg_match('`[0-9]+`', $match, $score);

            $data = [
                'username' => $name[0],
                'score' => $score[0],
            ];

            $ranking = Ranking::where('username', $data['username'])->first();
            if ($ranking) {
                $ranking->update($data);
            } else {
                Ranking::create($data);
            }
        }

        return redirect('/');
    }
}