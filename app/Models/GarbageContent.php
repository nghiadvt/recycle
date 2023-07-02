<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GarbageTitle;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GarbageContent extends Model
{
    use HasFactory;

    public $timestamp = true;

    protected $filltable = ['icon', 'title', 'content', 'active', 'garbage_title_id'];

    /**
     * Get the garbagetype that owns the garbageContent.
     */
    public function garbageTitle(): BelongsTo
    {
        return $this->belongsTo(GarbageTitle::class);
    }
}
