<?php

namespace App\Console\Commands;

use App\Image;
use App\Settings;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MediaCleanupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans up the media images that has expired.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $images = Image::where('created_at', '<', $this->generateCarbonTimestamp())->get();

        if ($images->isEmpty()) {
            return $this->info('There are nothing to cleanup!');
        }

        $this->info('Starting cleanup process for '.$images->count().' images...');

        foreach ($images as $image) {
            $image->delete();
        }

        $this->info('Done!');
    }

    /**
     * Generates the Carbon expiration object using the settings model, if all
     * the settings live values are at zero or below, a Carbon object set to
     * one minute in the past will be returned instead.
     *
     * @return Carbon\Carbon
     */
    protected function generateCarbonTimestamp()
    {
        $settings = Settings::first();

        if (! $settings->hasLiveValues()) {
            return Carbon::now()->subMinute();
        }

        return $settings->getLiveTimestamp();
    }
}
