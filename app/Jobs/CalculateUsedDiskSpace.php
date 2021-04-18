<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateUsedDiskSpace implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The user the disk space should be calculated for.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Total used disk space in bytes.
     *
     * @var integer
     */
    public $totalSize = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this
            ->calculateImageDiskSize()
            ->calculateTextDiskSize()
            ->calculateUrlDiskSize()
            ->saveTotalSpaceUsed();
    }

    /**
     * Saves the calculated total used disk space to the user.
     *
     * @return void
     */
    protected function saveTotalSpaceUsed()
    {
        $this->user->update(['disk_space_used' => $this->totalSize]);
    }

    /**
     * Calculate the total amount of disk space
     * used up by images for the given user.
     *
     * @return self
     */
    protected function calculateImageDiskSize()
    {
        foreach ($this->user->images()->cursor() as $image) {
            $this->totalSize += filesize(storage_path('app/images/' . $image->getResourceName()));

            foreach (Image::$supportedSizes as $size) {
                $this->totalSize += filesize(
                    storage_path('app/images/' . $image->getResourceName($size . 'x' . $size))
                );
            }
        }

        return $this;
    }

    /**
     * Calculate the total amount of disk space
     * used up by text for the given user.
     *
     * @return self
     */
    protected function calculateTextDiskSize()
    {
        foreach ($this->user->texts()->cursor() as $text) {
            $this->totalSize += mb_strlen($text->content);
        }

        return $this;
    }

    /**
     * Calculate the total amount of disk space used up
     * by urls and their previews for the given user.
     *
     * @return self
     */
    protected function calculateUrlDiskSize()
    {
        foreach ($this->user->urls()->cursor() as $url) {
            $this->totalSize += mb_strlen($url->url);

            $this->totalSize += filesize(storage_path('app/urls/' . $url->name . '.jpg'));
        }

        return $this;
    }
}
