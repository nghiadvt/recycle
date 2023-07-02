<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryIconObserver
{
    private function saveIcon(Category $category)
    {
        if ($category->icon) {
            $imageFile = $category['icon'];
            $pathActive = Category::ICON_DIRECTORY;
            createDirectory($pathActive);
            return saveImage($imageFile, $pathActive);
        }
        return null;
    }

    /**
     * Handle the GarbageType "creating" event.
     */
    public function creating(Category $category): void
    {
        $path = $this->saveIcon($category);
        $category->icon = basename($path);
    }
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    /**
     * Handle the Service "updating" event.
     */
    public function updating(Category $category): void
    {
        $oldIcon = $category->getOriginal('icon');
        $path = $this->saveIcon($category);

        if ($path) {
            Storage::delete(Category::ICON_DIRECTORY . '/' . $oldIcon);
        }
        $category->icon = basename($path);
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleting(Category $category): void
    {
        $oldIcon = $category->getOriginal('icon');
        if ($oldIcon) {
            Storage::delete(Category::ICON_DIRECTORY . '/' . $oldIcon);
        }
    }

    /**
     * Handle the Service "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $oldIcon = $category->getOriginal('icon');
        if ($oldIcon) {
            Storage::delete(Category::ICON_DIRECTORY . '/' . $oldIcon);
        }
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
