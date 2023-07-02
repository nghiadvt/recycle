<?php

namespace App\Observers;

use App\Models\ContainerGarbageType;

class MyObserver
{
    public function creating(ContainerGarbageType $containerGarbageType):void
    {
        dd($containerGarbageType);
        dd("xx");
    }
    /**
     * Handle the ContainerGarbageType "created" event.
     */
    public function created(ContainerGarbageType $containerGarbageType): void
    {
        dd("xxss");

    }

    /**
     * Handle the ContainerGarbageType "updated" event.
     */
    public function updated(ContainerGarbageType $containerGarbageType): void
    {
        //
    }

    /**
     * Handle the ContainerGarbageType "deleted" event.
     */
    public function deleted(ContainerGarbageType $containerGarbageType): void
    {
        //
    }

    /**
     * Handle the ContainerGarbageType "restored" event.
     */
    public function restored(ContainerGarbageType $containerGarbageType): void
    {
        //
    }

    /**
     * Handle the ContainerGarbageType "force deleted" event.
     */
    public function forceDeleted(ContainerGarbageType $containerGarbageType): void
    {
        //
    }
}
