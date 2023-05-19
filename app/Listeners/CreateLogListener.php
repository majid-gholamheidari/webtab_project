<?php

namespace App\Listeners;

use App\Events\CreateLog;
use App\Models\SystemLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class CreateLogListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreateLog $event): void
    {
        SystemLog::create([
            'model' => get_class($event->model),
            'data' => $event->model->toArray(),
            'action' => $event->action,
            'admin_id' => Auth::guard('admin')->id(),
            'id' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }
}
