<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class SlackProp extends Model
{
    protected $fillable = ['id', 'message', 'activity', 'ts', 'author_id', 'receiver_id'];

    public static function latest()
    {
        return SlackProp::query()->orderBy('created_at', 'DESC')->first();
    }

    public function receiver()
    {
        return $this->belongsTo('App\SlackUser', 'receiver_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo('App\SlackUser', 'author_id', 'id');
    }
}