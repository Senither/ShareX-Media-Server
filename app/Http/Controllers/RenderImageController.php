<?php

namespace App\Http\Controllers;

use App\Models\Image;
use GuzzleHttp\Psr7\MimeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RenderImageController extends Controller
{
    public function __invoke(Image $image, $type = null)
    {
        $path = 'images/' . $image->getResourceName($type);

        if (!Storage::exists($path)) {
            $path = 'images/' . $image->getResourceName();
        }

        return response(Storage::get($path))
            ->header('Content-Type', MimeType::fromExtension($image->extension));
    }
}
