<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

class DeactivateGovernments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deactivate:governments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate inactive governments';

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
     */
    public function handle()
    {
        \App\Jobs\DeactivateGovernments::dispatch();
    }
}
