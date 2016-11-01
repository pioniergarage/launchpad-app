<?php

namespace App\Http\Controllers;

use App\Ranking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //SELECT rankings.*
        //FROM rankings
        //JOIN (
        //    SELECT username, MAX(created_at) AS max_created_at
        //    FROM rankings
        //    GROUP BY username
        //) newest_rankings ON rankings.created_at = max_created_at AND newest_rankings.username = rankings.username
        $query = 'SELECT rankings.*
FROM rankings
JOIN (
	SELECT username, MAX(created_at) AS max_created_at 
	FROM rankings 
	GROUP BY username
) newest_rankings ON rankings.created_at = max_created_at AND newest_rankings.username = rankings.username
ORDER BY score DESC';
        $ranking = DB::select(DB::raw($query));

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

            Ranking::create($data);
        }

        return redirect('/');
    }
}