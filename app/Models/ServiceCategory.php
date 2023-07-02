<?php

namespace App\Models;

use App\Models\ServiceArticle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategory extends Model
{
    use HasFactory;

    const NAME = 'Service-Category';

    public $timestamp = true;

    protected $fillable = [
        'title',
        'parent_id',
        'slug',
        'description',
        'active'
    ];

    /**
     *
     *
     * @return BelongsTo
     */
    public function parentServiceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'parent_id');
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
