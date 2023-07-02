<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;
use App\Models\GarbageType;
use App\Models\GarbageContent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GarbageTitle extends Model
{
    use HasFactory;

    public $timestamp = true;

    protected $filltable = ['image', 'active', 'title', 'description', 'schedule_id', 'garbage_type_id'];
    protected $with = ['garbageContents'];

    /**
     * Get the schedule that owns the garbageTitle.
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Get the garbagetype that owns the garbageTitle.
     */
    public function garbagetype(): BelongsTo
    {
        return $this->belongsTo(GarbageType::class);
    }

    /**
     * Get the garbageContents for the blog garbageTitle.
     */
    public function garbageContents(): HasMany
    {
        return $this->hasMany(GarbageContent::class, 'garbage_title_id', 'id')
            ->select('id', 'icon', 'title', 'content', 'active', 'garbage_title_id', 'created_at');
    }
}
