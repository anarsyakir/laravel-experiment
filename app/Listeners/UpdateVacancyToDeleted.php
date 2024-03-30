<?php

namespace App\Listeners;

use App\Events\VacancyDeleted;
use App\Models\Vacancy;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateVacancyToDeleted
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
    public function handle(VacancyDeleted $event): void
    {
        $event->vacancy->status = 2;
        $event->vacancy->save();
    }
}
