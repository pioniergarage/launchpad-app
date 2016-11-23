<?php

namespace App\Services;


use App\SlackUser;
use Illuminate\Support\Facades\DB;

class Ranking
{
    public static function getRanking()
    {
        $query = 'SELECT receiver_id AS user_id, COUNT(*) AS score FROM slack_props GROUP BY receiver_id ORDER BY score DESC';
        $scores = DB::select(DB::raw($query));

        $ranking = [];
        foreach ($scores as $score) {
            $ranking[] = (object)[
                'user' => SlackUser::find($score->user_id),
                'score' => $score->score,
            ];
        }

        return $ranking;
    }
}