<?php

namespace App\Http\Controllers;

use App\User;
use App\Image;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image as ImageManager;

class ImageController extends Controller
{
    public function show(Image $image, $option = null)
    {
        return $this->loadImageResponse($image->slug, $option);
    }

    /**
     * Load the provided image and return it as a http response.
     *
     * @param  string $path
     * @param  string $option
     * @param  int    $statusCode
     * @return Illuminate\Http\Response
     */
    protected function loadImageResponse($image, $option, $statusCode = 200)
    {
        $path = 'images/' . ($option == null ? null : $option.'/');
        $path = storage_path($path.$image.'.png');

        if (! File::exists($path)) {
            abort(404);
        }

        $response = new Response(File::get($path), $statusCode);
        $response->header("Content-Type", File::mimeType($path));

        return $response;
    }

    public function store(Request $request)
    {
        $user = $this->getAuthenticatedTokenUser($request);

        if ($user == null) {
            return 'Invalid credentials given!';
        }

        $name  = str_random(rand(0, 5) + 4);
        $image = ImageManager::make($request->file('image'));

        Image::create([
            'user_id' => $user->id,
            'slug'    => $name,
            'height'  => $image->height(),
            'width'   => $image->width(),
        ]);

        $image->save(storage_path('images/'.$name.'.png'));
        $image->fit(254, 180);
        $image->save(storage_path('images/thumb/'.$name.'.png'));

        return action('ImageController@show', ['image' => $name]);
    }

    protected function getAuthenticatedTokenUser(Request $request)
    {
        if ($request->header('token') == null) {
            return null;
        }

        return User::where('token', $request->header('token'))->first();
    }
}
