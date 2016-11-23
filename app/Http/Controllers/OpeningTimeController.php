<?php

namespace App\Http\Controllers;


use App\OpeningTime;
use DateTime;

class OpeningTimeController extends Controller
{
    public function index()
    {
        $openingTimes = OpeningTime::query()
            ->orderBy('open_at', 'DESC')
            ->get()
            ->groupBy(function ($ot) {return $ot->open_at->toDateString();});

        $openedAt = OpeningTime::getOpenedAt();
        $firstOpenedAt = self::getOpenedAtDate($openedAt);

        //$closedAt = OpeningTime::getClosedAt();
        //$lastClosedAt = self::getClosedAtDate($closedAt);

        $averageOpenPerWeekday = self::getAveragePerWeekDay($firstOpenedAt);
        //$averageClosePerWeekday = self::getAveragePerWeekDay($lastClosedAt);

        //TODO: to calculate the average closing time you need to think about calc Swatch time not working when you have times before and after midnight.


        return view('opening-times.index', compact('openingTimes', 'averageOpenPerWeekday'));
    }

    /*
     * The getAveragePerWeekDay() function returns an array that contains the average open/close time per weekday for a certain set of datetimes.
     * Swatch time format is used to calculate the average time.
     */
    public function getAveragePerWeekDay($dates) {
        $averagePerWeekday = [];
        for ($i = 0; $i < 7; ++$i) {
            $sumSwatch = 0;
            $count = 0;
            for ($j = $i; $j < count($dates); $j += 7) {
                $dateSwatchTime = date('B', strtotime(str_replace('-','/', $dates[$j])));
                $sumSwatch += $dateSwatchTime;
                $count++;
            }
            $averageSwatch = ($sumSwatch / $count);
            array_push($averagePerWeekday, self::convertSwatchToTime($averageSwatch));
        }
        return $averagePerWeekday;
    }

    /*
     * The convertSwatchToTime() function returns a time in H:i format that was put in as Swatch time.
     */
    public function convertSwatchToTime($swatchTime) {
        $secondsSinceMidnight = $swatchTime * 86.4;
        $time = date('H:i', mktime(0,0, floor($secondsSinceMidnight), 0, 0, 0));
        return $time;
    }

    /*
     * The getOpenedAtDate() function returns the first time the door was opened at a certain date.
     * It starts looking from 5AM and after to sort out openings that where caused by people working late.
     */
    public function getOpenedAtDate($openingTimes)
    {
        $firstOpened = [];
        $currentDateDay = date('Y-m-d', strtotime('2000/01/01'));

        for ($i = 0; $i < count($openingTimes); ++$i) {

            $dateDay = date('Y-m-d', strtotime(str_replace('-','/', $openingTimes[$i]->open_at)));
            $dateHour = date('G', strtotime(str_replace('-','/', $openingTimes[$i]->open_at)));

            //next day
            if ($dateDay > $currentDateDay) {
                //after 5AM
                if ($dateHour >= 5) {
                    array_push($firstOpened, $openingTimes[$i]->open_at);
                    $currentDateDay = $dateDay;
                }
            }
        }
        return $firstOpened;
    }

    /*
     * The getClosedAtDate() function returns the last time the door was closed at a certain date.
     */
    public function getClosedAtDate($closingTimes)
    {
        $lastClosed = [];
        $currentDateDay = date('Y-m-d', strtotime(str_replace('-','/', $closingTimes[0]->close_at)));

        for ($i = 0; $i < (count($closingTimes) - 1); ++$i) {

            $dateDay = date('Y-m-d', strtotime(str_replace('-','/', $closingTimes[$i]->close_at)));
            $nextDate = date('Y-m-d', strtotime(str_replace('-','/', $closingTimes[$i + 1]->close_at)));
            $nextDateHour = date('G', strtotime(str_replace('-','/', $closingTimes[$i + 1]->close_at)));

            if ($nextDate > $dateDay) {
                //When LP was opened longer than midnight.
                if ($nextDateHour < 5) {
                    for ($j = ($i + 1); $j < (count($closingTimes)); ++$j) {
                        $dateTimeHour = date('G', strtotime(str_replace('-','/', $closingTimes[$j]->close_at)));
                        if ($dateTimeHour > 5) {
                            array_push($lastClosed, $closingTimes[($j - 1)]->close_at);
                            break;
                        }
                    }
                } else {
                    array_push($lastClosed, $closingTimes[$i]->close_at);
                }
            }
        }
        return $lastClosed;
    }

    public function apiCurrent()
    {
        return OpeningTime::query()
            ->orderBy('open_at', 'DESC')
            ->first();
    }
}