<?php

namespace App\Previewable;

use Illuminate\Support\Str;
use ZipArchive;

class ZipArchivePreview extends FilePreview
{
    /**
     * Creates the URL that should be used to access the preview of the file.
     *
     * @return string
     */
    public function url()
    {
        return route('view-file', [$this->file->name, 'preview', $this->file->original_name]);
    }

    /**
     * Render the file preview.
     *
     * @return mixed
     */
    public function render()
    {
        $zip = tap(new ZipArchive(), fn ($zip) => $zip->open(
            \storage_path('app/files/' . $this->file->getResourceName()),
            ZipArchive::RDONLY
        ));

        $items = [];

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $file = $zip->statIndex($i);

            if (Str::endsWith($file['name'], '/')) {
                continue;
            }

            $size = \convertByteToHuman($file['size']);

            $items[] = [
                'name' => $file['name'],
                'size' => $size['size'] . ' ' . $size['unit'],
            ];
        }

        return view('preview.zip-archive', [
            'file' => $this->file,
            'items' => $items,
            'hidePreview' => true,
        ]);
    }
}
