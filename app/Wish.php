<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $fillable = ['title', 'comment', 'thumbnail', 'link', 'show_title'];
}
