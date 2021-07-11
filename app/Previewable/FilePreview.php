<?php

namespace App\Previewable;

use App\Models\File;

abstract class FilePreview
{
    /**
     * The file model instance that the preview should be rendered for.
     *
     * @var \App\Models\File
     */
    protected $file;

    /**
     * Create the file preview instance.
     *
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Creates the URL that should be used to access the preview of the file.
     *
     * @return string
     */
    public function url()
    {
        if ($this->file->previewable && \file_exists(\public_path('fr'))) {
            return url('fr/' . $this->file->getResourceName());
        }

        return route('view-file', [$this->file->name, 'preview', $this->file->original_name]);
    }

    /**
     * Render the file preview.
     *
     * @return mixed
     */
    abstract public function render();
}
