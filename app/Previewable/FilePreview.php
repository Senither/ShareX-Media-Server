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
     * Render the file preview.
     *
     * @return mixed
     */
    abstract public function render();
}
