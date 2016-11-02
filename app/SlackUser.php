<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}