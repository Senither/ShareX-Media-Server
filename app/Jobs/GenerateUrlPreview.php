<?php

namespace App\Jobs;

use App\Models\Url;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use Spatie\Image\Manipulations;

class GenerateUrlPreview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The URL that the preview should be generated for.
     *
     * @var \App\Models\Url
     */
    public $model;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 30;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @param  \App\Models\Url $url
     * @return void
     */
    public function __construct(Url $url)
    {
        $this->model = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!Storage::exists('urls')) {
            Storage::makeDirectory('urls');
        }

        Browsershot::url($this->model->url)
            ->noSandbox()
            ->windowSize(640, 480)
            ->fit(Manipulations::FIT_CONTAIN, 256, 256)
            ->setScreenshotType('jpeg', 100)
            ->save(storage_path('app/urls/' . $this->model->name . '.jpg'));
    }
}
