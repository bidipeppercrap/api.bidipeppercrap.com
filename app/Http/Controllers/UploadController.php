<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt', 'role:root,admin']);
    }

    public function store(Request $request)
    {
        $path = Storage::disk('public')->putFile('uploads', $request->file('file'));
        $url = Storage::url($path);

        return $url;
    }
}
