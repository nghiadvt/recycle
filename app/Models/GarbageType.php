<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Scopes\DecreaseWithIDScope;
use Illuminate\Support\Facades\Storage;
use App\Models\GarbageTitle;
use Illuminate\Database\Eloquent\Builder;
use App\Enum\GarbageTypeUnitEnum;

class GarbageType extends Model
{
    use HasFactory;

    const NAME = 'garbage type';
    const COLUMNS = ['id', 'description', 'price', 'icon', 'name', 'active', 'created_at', 'unit'];
    const ICON_DIRECTORY = 'public/icons/garbage_types';
    const ACTIVE = 1;
    const NO_ACTIVE = 0;

    public $timestamp = true;

    protected $fillable = ['name', 'description', 'price', 'icon', 'active', 'unit'];
    protected $appends = ['URLImage'];
    protected $casts = [
        'unit' => GarbageTypeUnitEnum::class,
    ];

    /**
     * Get the garbageTitles for the GarbageType.
     */
    public function garbageTitles(): HasMany
    {
        return $this->hasMany(GarbageTitle::class, 'garbage_type_id', 'id');
    }

    //Create a virtual field to return the image URL.
    public function getURLImageAttribute()
    {
        if (strpos($this->icon, "http") !== false) {
            return  $this->icon;
        }
        return $this->icon ? url(Storage::url(self::ICON_DIRECTORY . '/' . $this->icon)) : null;
    }

    /**
     * Scope a query to only include active.
     */
    public function scopeActive(Builder $query, $type = self::ACTIVE): void
    {
        $query->where('active', $type);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new DecreaseWithIDScope());
    }

    /**
     * method containerGarbageTypes
     *
     * @return HasMany
     */
    public function containerGarbageTypes(): HasMany
    {
        return $this->hasMany(ContainerGarbageType::class);
    }
}
