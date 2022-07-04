<?php

namespace App\Console\Commands\Packages\Duplicati;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Models\Package;

class install extends Command

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duplicati:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Duplicati Install';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $package = Package::where('name', 'Webmin')->first();

        $process = new Process(['./install.sh']);
        $process->setTimeout(120);
        $process->start();

        foreach ($process as $type => $data) {
            echo $data;
        }
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return true;
    }
}
