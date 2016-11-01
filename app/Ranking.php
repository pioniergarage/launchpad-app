<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $fillable = ['username', 'score'];
}