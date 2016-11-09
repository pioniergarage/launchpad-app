<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SlackUser extends Model
{
    protected $fillable = ['id', 'name', 'real_name'];

    public $incrementing = false;

    public function receivedProps()
    {
        return $this->hasMany('App\SlackProp', 'receiver_id', 'id');
    }

    public function givenProps()
    {
        return $this->hasMany('App\SlackProp', 'author_id', 'id');
    }

    public function getName()
    {
        return ($this->real_name ? $this->real_name : '@' . $this->name);
    }

    public function getReceivedPropsPerMonth()
    {
        return (DB::query()->where('receiver_id', $this->id)->from('slack_props')->groupBy(DB::raw('WEEK(created_at)'))->select(DB::raw('WEEK(created_at) AS KW, count(*) AS Ranking'))->get());
    }
}