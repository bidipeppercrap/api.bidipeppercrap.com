<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'comment', 'thumbnail', 'link', 'show_title'];
}
