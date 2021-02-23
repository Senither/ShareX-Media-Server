<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Scopes\UserScope;
use GuzzleHttp\Psr7\MimeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RenderImageController extends Controller
{
    /**
     * Invokes the method automatically when the
     * class is called as a function.
     *
     * @param  string $id
     * @param  string|null $type
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, $type = null)
    {
        $image = $this->loadImageOrFail($id);

        $path = 'images/' . $image->getResourceName($type);

        if (!Storage::exists($path)) {
            $path = 'images/' . $image->getResourceName();
        }

        return response(Storage::get($path))
            ->header('Content-Type', MimeType::fromExtension($image->extension));
    }

    /**
     * Loads the image with the given name, or fails trying.
     *
     * @param  string $name
     * @return \App\Models\Image
     */
    protected function loadImageOrFail($name)
    {
        return Image::withoutGlobalScope(UserScope::class)
            ->where('name', $name)
            ->first();
    }
}
