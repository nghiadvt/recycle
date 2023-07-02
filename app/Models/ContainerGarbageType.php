<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\GarbageType;
use Illuminate\Support\Facades\Storage;
use App\Enum\ContainerGarbageEnum;

class ContainerGarbageType extends Model
{
    use HasFactory;

    const NAME = 'Container Garbage Type';
    const IMAGE_DIRECTORY = 'public/image_urls/containerGarbage';

    public $timestamp = true;

    protected $fillable = [
        'id',
        'garbage_type_id',
        'bin_size',
        'image',
    ];

    protected $hidden = [
        'updated_at'
    ];

    protected $appends = ['URLImage'];

    //Create a virtual field to return the image URL.
    /**
     *
     *
     * @return string
     */
    public function getURLImageAttribute()
    {
        if (strpos($this->image, "http") !== false) {
            return  $this->image;
        }
        return $this->image ? url(Storage::url(self::IMAGE_DIRECTORY . '/' . $this->image)) : null;
    }

    /**
     * method damagedMissingTypes
     *
     * @return HasMany
     */
    public function damagedMissingTypes(): HasMany
    {
        return $this->hasMany(ServiceCategory::class);
    }

    /**
     * method garbageType
     *
     * @return BelongsTo
     */
    public function garbageType(): BelongsTo
    {
        return $this->belongsTo(GarbageType::class);
    }
}
