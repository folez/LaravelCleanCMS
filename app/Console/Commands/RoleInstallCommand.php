<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RoleInstallCommand extends Command
{
	protected $signature = 'role:install';

	protected $description = 'Run this command from ease install spatie\permission';

	public function handle()
	{
		if($this->confirm('Install role package?', true)){
            $bar = $this->output->createProgressBar(100);
            $bar->start();
            shell_exec('composer require spatie/laravel-permission --ignore-platform-reqs');
            $bar->finish();
            $this->newLine();
            $this->info('Package install');
            $this->newLine();
            $this->info('Publishing role config...');
            shell_exec('php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"');
            $this->newLine();
            $this->info('Role config success published');
            $this->newLine();
            $this->info('Role package success installed');
        }
	}
}
#create,edit,delete test
#create,edit,delete users
#create,edit,delete,merge groups
