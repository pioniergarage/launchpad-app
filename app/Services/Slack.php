<?php

namespace App\Services;

use App\SlackProp;
use App\SlackUser;

class Slack
{
    /**
     * Import data from Slack and send ranking to Slack.
     * @return boolean Rankings sent
     */
    public static function beGrowbot()
    {
        $newestBeforeUpdate = SlackProp::latest() ? SlackProp::latest()->created_at : null;
        self::importProps();
        $newestAfterUpdate = SlackProp::latest() ? SlackProp::latest()->created_at : null;

        // send ranking if new props were added
        if ($newestBeforeUpdate != null && $newestAfterUpdate != null
            && $newestAfterUpdate->gt($newestBeforeUpdate)) {
            self::sendRanking();
            return true;
        }

        return false;
    }

    public static function importProps()
    {
        $channelHistoryEndpoint = 'https://slack.com/api/channels.history?token=' . env('SLACK_TOKEN') . '&channel=' . env('SLACK_CHANNEL') . '&sort=timestamp&sort_dir=asc&count=1000';

        $resultPlain = file_get_contents($channelHistoryEndpoint);
        $resultJson = json_decode($resultPlain);
        $matches = $resultJson->messages;
        //dd($matches);

        $props = [];
        foreach ($matches as $match) {
            $message = $match->text;

            $propsPattern = '/props <@[a-zA-Z0-9_]+> .*/';
            $isMatchingPropsPattern = preg_match($propsPattern, $message);

            if ($isMatchingPropsPattern) {
                $author = self::importUser($match->user);

                // extract user
                preg_match('/<@[a-zA-Z0-9_]+>/', $message, $matchResult);
                $userId = str_replace(['<', '>', '@'], '', $matchResult[0]);
                $receiver = self::importUser($userId);

                // extract activity
                $indexOfLastUserTagEnd = strrpos($message, '>');
                $indexOfActivityStart = $indexOfLastUserTagEnd + 1;
                $activity = trim(substr($message, $indexOfActivityStart));

                // add to array
                $props[] = compact('author', 'receiver', 'activity', 'message', 'match');
            } else {
                // wrong syntax -> ignore
            }
        }

        foreach ($props as $prop) {
            $slackProp = SlackProp::query()
                ->where('ts', $prop['match']->ts)
                ->where('author_id', $prop['author']->id)
                ->first();

            if (! $slackProp) {
                $slackProp = new SlackProp();
            }

            $slackProp->fill([
                'message' => $prop['message'],
                'activity' => $prop['activity'],
                'ts' => $prop['match']->ts,
                'author_id' => $prop['author']->id,
                'receiver_id' => $prop['receiver']->id,
            ]);
            $slackProp->save();
        }
    }

    public static function importUser($id)
    {
        $user = SlackUser::find($id);
        if (! $user) {
            $user = new SlackUser();
        }

        $slackUser = self::usersInfo($id);
        $user->fill([
            'id' => $slackUser->id,
            'name' => $slackUser->name,
            'real_name' => $slackUser->real_name,
        ]);
        $user->save();

        return $user;
    }

    public static function usersInfo($id)
    {
        $endpoint = 'https://slack.com/api/users.info?token=' . env('SLACK_TOKEN') . '&user=' . $id;
        return json_decode(file_get_contents($endpoint))->user;
    }

    public static function sendRanking()
    {
        $ranking = Ranking::getRanking();

        $rankToRankingLine = function ($rank) {
            // use getName to fetch real name if possible
            // -> avoids pings for every ranking
            return $rank->user->getName() . ': ' . $rank->score;
        };
        $rankingLines = array_map($rankToRankingLine, $ranking);
        $text = "Das aktuelle Ranking ist:\n" . implode("\n", $rankingLines);

        $endpoint = 'https://slack.com/api/chat.postMessage?token=' . env('SLACK_TOKEN') . '&channel=' . env('SLACK_CHANNEL') . '&parse=full&text=' . urlencode($text);
        return json_decode(file_get_contents($endpoint));
    }
}