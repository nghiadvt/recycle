<?php

namespace App\Models;

use App\Models\ServiceArticle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory;

    const NAME = 'Service';
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const IMAGE_URL_DIRECTORY = 'public/image_urls/services';
    const COLUMNS = ['id', 'title', 'slug', 'image_url', 'content', 'description', 'active', 'created_at'];

    public $timestamp = true;

    protected $fillable = [
        'title',
        'slug',
        'image_url',
        'content',
        'description',
        'active'
    ];

    protected $appends = ['URLImage'];

    /**
     *
     *
     * @return string
     * Create a virtual field to return the image URL.
     */
    public function getURLImageAttribute()
    {
        return $this->image_url ? url(Storage::url(self::IMAGE_URL_DIRECTORY . '/' . $this->image_url)) : null;
    }

    /**
     *
     *
     * @return HasMany
     */
    public function serviceArticles(): HasMany
    {
        return $this->hasMany(ServiceArticle::class);
    }
}
