<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Scopes\UserScope;

class RenderFileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  string $id
     * @param  string|null $type
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, $raw = null)
    {
        $file = $this->loadFileOrFail($id);

        return response($file->content);
    }

    /**
     * Loads the file with the given name, or fails trying.
     *
     * @param  string $name
     * @return \App\Models\File
     */
    protected function loadFileOrFail($name)
    {
        $parts = explode('.', $name);

        $file = File::withoutGlobalScope(UserScope::class)
            ->where('name', array_shift($parts))
            ->firstOrFail();

        if (count($parts) > 0) {
            abort_unless($parts[0] == $file->extension, 404);
        }

        return $file;
    }
}
