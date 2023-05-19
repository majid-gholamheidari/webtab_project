<?php

namespace App\Jobs;

use App\Events\CreateLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $model;
    private $action;
    /**
     * Create a new job instance.
     */
    public function __construct($model, $action)
    {
        $this->model = $model;
        $this->action = $action;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        event(new CreateLog($this->model, $this->action));
    }
}
