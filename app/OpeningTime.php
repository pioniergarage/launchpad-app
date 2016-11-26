<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OpeningTime extends Model
{
    protected $fillable = ['open_at', 'close_at', 'is_public', 'is_visible'];
    protected $dates = ['open_at', 'close_at'];

    public static function getLast()
    {
        return self::query()->orderBy('open_at', 'DESC')->first();
    }

    public function isOpen()
    {
        return $this->close_at === null;
    }


    public static function getOpenedAt()
    {
        $openedAt = DB::select('SELECT open_at FROM opening_times');
        return $openedAt;
    }

    public static function getClosedAt()
    {
        $closedAt = DB::select('SELECT close_at FROM opening_times');
        return $closedAt;
    }
}