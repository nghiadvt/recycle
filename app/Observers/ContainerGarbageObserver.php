<?php

namespace App\Observers;

use App\Models\ContainerGarbageType;
use Illuminate\Support\Facades\Storage;

class ContainerGarbageObserver
{
    private function saveImage(ContainerGarbageType $containerGarbageService)
    {
        if ($containerGarbageService->image) {
            if (is_string($containerGarbageService->image)) {
                return $containerGarbageService->image;
            }
            $imageFile = $containerGarbageService['image'];
            $pathActive = ContainerGarbageType::IMAGE_DIRECTORY;

            return saveImage($imageFile, $pathActive);
        }
        return null;
    }

    /**
     * Handle the Service "creating" event.
     */
    public function creating(ContainerGarbageType $containerGarbageService): void
    {
        $path = $this->saveImage($containerGarbageService);
        $containerGarbageService->image = basename($path);
    }

    /**
     * Handle the Service "created" event.
     */
    public function created(ContainerGarbageType $containerGarbageService): void
    {
        //
    }

    /**
     * Handle the Service "updating" event.
     */
    public function updating(ContainerGarbageType $containerGarbageService): void
    {
        $oldImage = $containerGarbageService->getOriginal('image');
        $path = $this->saveImage($containerGarbageService);

        if ($path != $oldImage) {
            Storage::delete(ContainerGarbageType::IMAGE_DIRECTORY . '/' . $oldImage);
        }
        $containerGarbageService->image = basename($path);
    }

    /**
     * Handle the Service "updated" event.
     */
    public function updated(ContainerGarbageType $containerGarbageService): void
    {
        //
    }
    /**
     * Handle the GarbageType "deleted" event.
     */
    public function deleting(ContainerGarbageType $garbageType): void
    {
        $oldIcon = $garbageType->getOriginal('image');
        if ($oldIcon) {
            Storage::delete(ContainerGarbageType::IMAGE_DIRECTORY . '/' . $oldIcon);
        }
    }
    /**
     * Handle the Service "deleted" event.
     */
    public function deleted(ContainerGarbageType $containerGarbageService): void
    {
        $oldImage = $containerGarbageService->getOriginal('image');
        if ($oldImage) {
            Storage::delete(ContainerGarbageType::IMAGE_DIRECTORY . '/' . $oldImage);
        }
    }

    /**
     * Handle the Service "restored" event.
     */
    public function restored(ContainerGarbageType $containerGarbageService): void
    {
        //
    }

    /**
     * Handle the Service "force deleted" event.
     */
    public function forceDeleted(ContainerGarbageType $containerGarbageService): void
    {
        //
    }
}
