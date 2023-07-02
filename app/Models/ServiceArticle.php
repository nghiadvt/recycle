<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ServiceCategory;

class ServiceArticle extends Model
{
    use HasFactory;

    const NAME = "Service Article";
    const ACTIVE = 1;
    const INACTIVE = 0;
    const COLUMNS = ['id', 'services_category_id', 'services_id', 'title', 'slug', 'content', 'description', 'active', 'created_at'];

    protected $fillable = [
        'services_category_id',
        'services_id',
        'title',
        'slug',
        'content',
        'description',
        'active'
    ];

    /**
     *
     *
     * @return BelongsTo
     */
    public function services(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     *
     *
     * @return BelongsTo
     */
    public function services_category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }
}
