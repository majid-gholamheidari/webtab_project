<?php

namespace App\Observers;

use App\Jobs\CreateLogJob;
use Illuminate\Foundation\Bus\DispatchesJobs;

class LogObserver
{
    use DispatchesJobs;
    public function created($model)
    {
        $this->dispatch(new CreateLogJob($model, 'created'));
    }

    public function updated($model)
    {
        $this->dispatch(new CreateLogJob($model, 'updated'));
    }

    public function deleted($model)
    {
        $this->dispatch(new CreateLogJob($model, 'deleted'));
    }

    public function restored($model)
    {
        $this->dispatch(new CreateLogJob($model, 'restored'));
    }
}
