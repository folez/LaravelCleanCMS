<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 *
 */
class installCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'project:install';

    /**
     * @var string
     */
    protected $description = 'Use this command for install you project on deployment server';

    /**
     * @description handle install project, run migrate,seed and link storage symlink
     */
    public function handle(): void
	{
        $this->info('Started project install...');

        $this->info('Started database migration');
        Artisan::call('migrate');
        $this->info('Completed database migration');

        $this->info('Started database seeding');
        Artisan::call('db:seed');
        $this->info('Completed database seeding');

        $this->info('Start storage linking');
        Artisan::call('storage:link --force');
        $this->info('Completed storage linking');

        $this->info('Project completed install');
	}
}
