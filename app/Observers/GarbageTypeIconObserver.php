<?php

namespace App\Observers;

use App\Models\GarbageType;
use Illuminate\Support\Facades\Storage;

class GarbageTypeIconObserver
{
    private function saveIcon(GarbageType $garbageType)
    {
        if ($garbageType->icon) {
            $imageFile = $garbageType['icon'];
            $pathActive = GarbageType::ICON_DIRECTORY;
            createDirectory($pathActive);
            return saveImage($imageFile, $pathActive);
        }

        return null;
    }

    /**
     * Handle the post "saving" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function saved(GarbageType $garbageType)
    {
    }

    /**
     * Handle the GarbageType "creating" event.
     */
    public function creating(GarbageType $garbageType): void
    {
        $path = $this->saveIcon($garbageType);
        $garbageType->icon = basename($path);
    }

    /**
     * Handle the GarbageType "updated" event.
     */
    public function updating(GarbageType $garbageType): void
    {
        $oldIcon = $garbageType->getOriginal('icon');
        $path = $this->saveIcon($garbageType);

        if ($path) {
            Storage::delete(GarbageType::ICON_DIRECTORY . '/' . $oldIcon);
        }
        $garbageType->icon = basename($path);
    }

    /**
     * Handle the GarbageType "deleted" event.
     */
    public function deleting(GarbageType $garbageType): void
    {
        $oldIcon = $garbageType->getOriginal('icon');
        if ($oldIcon) {
            Storage::delete(GarbageType::ICON_DIRECTORY . '/' . $oldIcon);
        }
    }

    /**
     * Handle the GarbageType "restored" event.
     */
    public function restored(GarbageType $garbageType): void
    {
        //
    }

    /**
     * Handle the GarbageType "force deleted" event.
     */
    public function forceDeleted(GarbageType $garbageType): void
    {
        //
    }
}
