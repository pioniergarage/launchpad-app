<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlackUser extends Model
{
    protected $fillable = ['id', 'name', 'real_name'];

    public $incrementing = false;
}