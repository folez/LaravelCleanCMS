<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RoleUnistallCommand extends Command
{
    protected $signature = 'role:uninstall';

    protected $description = 'Run this command from easy uninstall spatie\permission';

    public function handle()
    {
        if($this->confirm('Uninstall role package?', true)){
            $bar = $this->output->createProgressBar(100);
            $bar->start();
            shell_exec('composer remove spatie/laravel-permission');
            $bar->finish();
            $this->newLine();
            $this->info('Package uninstall');
            $this->newLine();
            $this->info('Deleting role config...');
//            shell_exec('php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"');
            $this->newLine();
            $this->info('Role config success deleted');
            $this->newLine();
            $this->info('Role package success uninstalled');
        }
    }
}
