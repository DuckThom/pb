<?php

namespace App\Console\Commands;

use File;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * Class CleanOldPastes.
 */
class CleanOldPastes extends Command
{
    /**
     * @var string
     */
    protected $name = 'clean:pastes';

    /**
     * @var string
     */
    protected $description = 'Remove old pastes from the filesystem';

    /**
     * Command handler.
     */
    public function handle()
    {
        $dirs = File::directories(storage_path('code'));
        $removedDirCount = 0;

        foreach ($dirs as $dir) {
            $dt = Carbon::createFromTimestampUTC(File::lastModified($dir));
            $age = $dt->diffInDays(Carbon::now());

            if ($age >= 7) {
                $removedDirCount++;
                $this->info("Removed: {$dir} - Age: {$age}");
                File::deleteDirectory($dir);
            }
        }

        $this->info("Removed {$removedDirCount} pastes");
    }
}
