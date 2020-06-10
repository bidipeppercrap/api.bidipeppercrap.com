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
            'message' => 'Welcome to bidipeppercrap.com!',
            'author_name' => 'bidipeppercrap',
            'author_email' => 'bidipeppercrap@outlook.com',
            'author_phone' => '+62 852 5058 5135'
        ];
    }
}
