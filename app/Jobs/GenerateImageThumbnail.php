<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageGenerator;

class GenerateImageThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The image that should have thumbnails generated.
     *
     * @var \App\Models\Image
     */
    public $image;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $generator = ImageGenerator::make(Storage::get('images/' . $this->image->getResourceName()));

        $this->resizeAndSave($generator, 512);
        $this->resizeAndSave($generator, 256);
        $this->resizeAndSave($generator, 128);
    }

    protected function resizeAndSave($generator, $size)
    {
        $generator->fit($size, $size);

        $generator->save(storage_path('app/images/' . $this->image->getResourceName($size . 'x' . $size)));
    }
}
