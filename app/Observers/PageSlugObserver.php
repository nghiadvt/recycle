<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Str;

class PageSlugObserver
{
    /**
     * Handle the Page "creating" event.
     */
    public function creating(Page $page): void
    {
        $page->slug = Str::slug($page['title']);
    }

    /**
     * Handle the Page "updating" event.
     */
    public function updating(Page $page): void
    {
        $page->slug = Str::slug($page['title']);
    }

    /**
     * Handle the Page "deleted" event.
     */
    public function deleted(Page $page): void
    {
        //
    }

    /**
     * Handle the Page "restored" event.
     */
    public function restored(Page $page): void
    {
        //
    }

    /**
     * Handle the Page "force deleted" event.
     */
    public function forceDeleted(Page $page): void
    {
        //
    }
}
