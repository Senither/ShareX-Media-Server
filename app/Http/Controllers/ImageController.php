<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __invoke()
    {
        return view('images.index');
    }
}
