<?php

namespace App\Console\Commands;

use App\Jobs\CalculateUsedDiskSpace;
use App\Models\File;
use App\Models\Image;
use App\Models\Text;
use App\Models\Url;
use App\Settings\SettingsManager;
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
    protected $description = 'Deletes all the media resources that have expired.';

    /**
     * The application settings.
     *
     * @var \App\Settings\SettingsManager
     */
    protected $settings;

    /**
     * The list of models that should be cleaned up, where the key is the
     *  model itself, and the value is the name/settings key which is
     * used to determine if records have actually expired.
     *
     * @var array
     */
    protected $models = [
        Image::class => 'images',
        Text::class => 'texts',
        Url::class => 'urls',
        File::class => 'files',
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SettingsManager $settings)
    {
        parent::__construct();

        $this->settings = $settings;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $affectedUsers = $this->cleanupExpiredModels();

        if ($affectedUsers->isEmpty()) {
            return 0;
        }

        $this->info('');
        $this->info($affectedUsers->count() . ' users were affected by the cleanup');
        $this->info('Recalculating used disk space for all affected users');

        foreach ($affectedUsers as $user) {
            CalculateUsedDiskSpace::dispatch($user);
        }
    }

    /**
     * Cleans up expired model records by deleting
     * them from the database and from the disk.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function cleanupExpiredModels()
    {
        $affectedUsers = \collect();

        foreach ($this->models as $model => $name) {
            $this->info('');
            $this->info('Starting cleanup for ' . $name);

            // Loads the model records that have expired along
            // with the user that the record belongs to.
            $items = $model::with('owner')
                ->where('created_at', '<', $this->createTimestampFor($name))
                ->get();

            if ($items->isEmpty()) {
                $this->warn('> Found no ' . $name . ' records to cleanup, skipping...');

                continue;
            }

            $this->info('> Found ' . $items->count() . ' expired record, starting cleanup process');

            $progress = $this->output->createProgressBar($items->count());
            $progress->setMessage('Deleting ' . $name . '...');
            $progress->start();

            // Loops over every expired record, pushing the owner user
            // instance to the affected users collection, then
            // deletes the record from the database.
            foreach ($items as $instance) {
                $affectedUsers->push($instance->owner);

                $instance->delete();

                $progress->advance();
            }

            $progress->finish();

            $this->info('');
            $this->info('> Done!');
        }

        return $affectedUsers->unique();
    }

    /**
     * Creates a Carbon timestamp using the given settings type.
     *
     * @param  string $type
     * @return \Carbon\Carbon
     */
    protected function createTimestampFor($type)
    {
        return now()
            ->subDays($this->settings->get($type . '.ttl_days'))
            ->subHours($this->settings->get($type . '.ttl_hours'))
            ->subMinutes($this->settings->get($type . '.ttl_minutes'));
    }
}
