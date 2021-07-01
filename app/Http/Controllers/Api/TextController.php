<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TextUploadRequest;
use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
    /**
     * Setup the image policy used in the controller for authorization.
     */
    public function __construct()
    {
        $this->authorizeResource(Text::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request)
    {
        return Text::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TextUploadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TextUploadRequest $request)
    {
        $file = Text::createAndSave($request->file('file'));

        if ($request->header('Accept') == 'text/plain') {
            $file = $file->resource_url;
        }

        return response($file, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Text  $text
     * @return \App\Models\Text
     */
    public function show(Text $text)
    {
        return $text;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Text  $text
     * @return \Illuminate\Http\Response
     */
    public function destroy(Text $text)
    {
        $text->delete();

        return response(null, 204);
    }
}
