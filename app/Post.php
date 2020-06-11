<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'display_title', 'subtitle', 'thumbnail', 'pinned'];
}
