<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class OpeningTime extends Model
{
    protected $fillable = ['open_at', 'close_at', 'is_public', 'is_visible'];
    protected $dates = ['open_at', 'close_at'];
}