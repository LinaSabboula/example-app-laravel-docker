<?php

namespace App\Jobs;

use App\Http\Controllers\InactiveGovernmentController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class addInactiveGovernmentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $updatedGovernments;

    public function __construct(Collection $updatedGovernments)
    {
        $this->updatedGovernments = $updatedGovernments;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $inactiveGovernment = new InactiveGovernmentController();
        $inactiveGovernment->addInactive($this->updatedGovernments);
    }
}
