<?php

namespace App\Http\Controllers;

use App\Image;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageAdminController extends Controller
{
    public function index()
    {
        $images = Image::with('owner')->authAll()
                       ->orderBy('created_at')->get();

        return view('image.index', compact('images'));
    }

    public function destory($id)
    {
        $image = Image::with('owner')->find($id);

        if ($image == null) {
            flash()->warning(
                'Invalid image ID Provided!',
                'The provided image ID does not exists within our records'
            );
            return redirect()->action('ImageAdminController@index');
        }

        if (! $this->canDelete($image)) {
            flash()->warning(
                'Insufficient permission to delete the given image!',
                'You attempted to delete an image that you don\'t have access to.'
            );
            return redirect()->action('ImageAdminController@index');
        }

        $image->delete();
        
        return redirect()->action('ImageAdminController@index');
    }

    protected function canDelete(Image $image)
    {
        return $image->user_id != Auth::user()->id
            ? Auth::user()->hasPermission('user.image.delete.others')
            : Auth::user()->hasPermission('user.image.delete');
    }
}
