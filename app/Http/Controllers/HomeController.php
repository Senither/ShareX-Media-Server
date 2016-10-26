<?php

namespace App\Http\Controllers;

use App\Image;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $images = Image::paginate($this->settings()->per_page);

        return view('home', compact('images'));
    }
}
