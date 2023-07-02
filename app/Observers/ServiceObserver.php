<?php

namespace App\Observers;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceObserver
{
    private function saveImage(Service $service)
    {
        if ($service->image_url) {
            $imageFile = $service['image_url'];
            $pathActive = Service::IMAGE_URL_DIRECTORY;
            createDirectory($pathActive);

            return saveImage($imageFile, $pathActive);
        }

        return null;
    }

    /**
     * Handle the Service "creating" event.
     */
    public function creating(Service $service): void
    {
        $path = $this->saveImage($service);
        $service->image_url = basename($path);
    }

    /**
     * Handle the Service "created" event.
     */
    public function created(Service $service): void
    {
        //
    }

    /**
     * Handle the Service "updating" event.
     */
    public function updating(Service $service): void
    {
        $oldImage = $service->getOriginal('image_url');
        $path = $this->saveImage($service);

        if ($path) {
            Storage::delete(Service::IMAGE_URL_DIRECTORY . '/' . $oldImage);
        }
        $service->image_url = basename($path);
    }

    /**
     * Handle the Service "updated" event.
     */
    public function updated(Service $service): void
    {
        //
    }

    /**
     * Handle the Service "deleted" event.
     */
    public function deleting(Service $service): void
    {
        $oldImage = $service->getOriginal('icon');
        if ($oldImage) {
            Storage::delete(Service::IMAGE_URL_DIRECTORY . '/' . $oldImage);
        }
    }

    /**
     * Handle the Service "deleted" event.
     */
    public function deleted(Service $service): void
    {
        $oldImage = $service->getOriginal('image_url');
        if ($oldImage) {
            Storage::delete(Service::IMAGE_URL_DIRECTORY . '/' . $oldImage);
        }
    }

    /**
     * Handle the Service "restored" event.
     */
    public function restored(Service $service): void
    {
        //
    }

    /**
     * Handle the Service "force deleted" event.
     */
    public function forceDeleted(Service $service): void
    {
        //
    }
}
