<?php

namespace App\Console\Commands;

use App\Jobs\AutoImportPostJob;
use App\Services\ImportService;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Throwable;

class AutoImportPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:autoimport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will import all posts from external source to local database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $jobs = [];

        // get list of all imports from import service
        (new ImportService())->getImportsToExecute()->each(function ($import) use (&$jobs) {
            $jobs[] = new AutoImportPostJob($import);
        });

        // execute jobs if there are any
        if (count($jobs) > 0) {
            // dispatch batch job using Bus
            Bus::batch($jobs)
                ->then(function (Batch $batch) {
                    // if batch is successful, print success message
                    info('Auto import posts successful');
                })
                ->catch(function (Batch $batch, Throwable $e) {
                    info("job not successful.". $e->getMessage());
                })
                ->allowFailures()
                ->name('post:autoimport')
                ->dispatch();
        }
    }
}
