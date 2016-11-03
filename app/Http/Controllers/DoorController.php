<?php

namespace App\Http\Controllers;

use App\OpeningTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoorController extends Controller
{
    public function changeStatus(Request $request)
    {
        $doorStatusWritten = $request->input('door');
        if (! $doorStatusWritten) {
            return ['error' => "Door parameter not set. Please use 'open' or 'closed' as values"];
        }

        $doorStatusWrittenToBool = [
            'open' => true,
            'closed' => false,
        ];

        if (! in_array($doorStatusWritten, array_keys($doorStatusWrittenToBool))) {
            return ['error' => "Unknown door value. Please use 'open' or 'closed'"];
        }

        $isOpen = $doorStatusWrittenToBool[$doorStatusWritten];

        if ($isOpen) {
            // create new opening (only when last one was closed)
            $openingTime = $this->getLastOpeningTime();
            $isLaunchpadClosed = $openingTime ? $openingTime->close_at : true;

            if ($isLaunchpadClosed) {
                $openingTime = OpeningTime::create([
                    'open_at' => Carbon::now(),
                    'close_at' => null,
                    'is_public' => true,
                    'is_visible' => true,
                ]);
            } else {
                // do nothing as it is already open
            }
        } else {
            // close last opening time
            $openingTime = $this->getLastOpeningTime();
            $openingTime->close_at = Carbon::now();
            $openingTime->save();
        }

        return $openingTime;
    }

    /**
     * @return mixed
     */
    public function getLastOpeningTime()
    {
        return OpeningTime::query()->orderBy('open_at', 'DESC')->first();
    }
}