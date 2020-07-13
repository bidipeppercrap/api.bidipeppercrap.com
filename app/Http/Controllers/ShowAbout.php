<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowAbout extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return [
            'author_name' => env('AUTHOR_NAME'),
            'author_email' => env('AUTHOR_EMAIL'),
            'author_phone' => env('AUTHOR_PHONE')
        ];
    }
}
