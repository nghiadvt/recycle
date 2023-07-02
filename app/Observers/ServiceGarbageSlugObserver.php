<?php

namespace App\Observers;

use App\Models\ServiceGarbage;
use Illuminate\Support\Str;

class ServiceGarbageSlugObserver
{
    /**
     * Handle the ServiceGarbage "created" event.
     */
    public function creating(ServiceGarbage $serviceGarbage): void
    {
        $serviceGarbage->slug = Str::slug($serviceGarbage['name']);
    }

    /**
     * Handle the ServiceGarbage "updated" event.
     */
    public function updating(ServiceGarbage $serviceGarbage): void
    {
        $serviceGarbage->slug = Str::slug($serviceGarbage['name']);
    }

    /**
     * Handle the ServiceGarbage "deleted" event.
     */
    public function deleted(ServiceGarbage $serviceGarbage): void
    {
        //
    }

    /**
     * Handle the ServiceGarbage "restored" event.
     */
    public function restored(ServiceGarbage $serviceGarbage): void
    {
        //
    }

    /**
     * Handle the ServiceGarbage "force deleted" event.
     */
    public function forceDeleted(ServiceGarbage $serviceGarbage): void
    {
        //
    }
}
