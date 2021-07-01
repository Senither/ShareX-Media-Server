<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Setup the file policy used in the controller for authorization.
     */
    public function __construct()
    {
        $this->authorizeResource(File::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function index()
    {
        return File::simplePaginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = File::createAndSave($request->file('file'));

        if ($request->header('Accept') == 'text/plain') {
            $file = $file->resource_url;
        }

        return response($file, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \App\Models\File
     */
    public function show(File $file)
    {
        return $file;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->delete();

        return response(null, 204);
    }
}
