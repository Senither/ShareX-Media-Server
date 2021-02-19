<?php

namespace App\Http\Controllers;

use App\Models\Image;
use GuzzleHttp\Psr7\MimeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RenderImageController extends Controller
{
    public function __invoke(Image $image)
    {
        return response(Storage::get('images/' . $image->getResourceName()))
            ->header('Content-Type', MimeType::fromExtension($image->extension));
    }
}
