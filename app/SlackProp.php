<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class SlackProp extends Model
{
    protected $fillable = ['id', 'message', 'activity', 'ts', 'author_id', 'receiver_id'];
}