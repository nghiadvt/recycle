<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const INACTIVE = 0;
    const NAME = "Category";
    const ICON_DIRECTORY = 'public/icons/categories';
    const COLUMNS = [
        'id',
        'name',
        'description',
        'icon',
        'parent_id',
        'is_active',
        'created_at'
    ];

    protected $table = "categories";
    protected $timestamp = true;
    protected $fillable = [
        'id',
        'name',
        'description',
        'icon',
        'parent_id',
        'is_active'
    ];
    protected $hidden = ['update_at'];
    protected $appends = ['URLImage'];

    /**
     * getURLImageAttribute function
     *
     * @return void
     */
    public function getURLImageAttribute()
    {
        if (strpos($this->icon, "http") !== false) {
            return  $this->icon;
        }
        return $this->icon ? url(Storage::url(self::ICON_DIRECTORY . '/' . $this->icon)) : null;
    }

    /**
     * advertise_campaigns function
     *
     * @return HasMany
     */
    public function advertise_campaigns(): HasMany
    {
        return $this->hasMany(AdvertiseCampaigns::class);
    }
}
