<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceGarbageContent;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Scopes\DecreaseWithIDScope;
use App\Traits\FilterableTrait;
use Illuminate\Database\Eloquent\Builder;

class ServiceGarbage extends Model
{
    use FilterableTrait;
    use HasFactory;

    const COLUMNS_SERVICE_GARBAGES = ['id', 'name', 'slug', 'active', 'parent_id', 'created_at'];
    const COLUMNS_SERVICE_GARBAGE = ['id', 'name', 'slug', 'content', 'description', 'active', 'parent_id', 'created_at'];
    const NAME = 'service garbage';
    const ACTIVE = 1;
    const NO_ACTIVE = 0;

    protected $fillable  = ['name', 'parent_id', 'slug', 'description', 'content', 'active'];
    protected $hidden = ['updated_at'];

    /**
     * Get the serviceGarbageContent for the blog serviceGarbage.
     */
    public function serviceGarbageContents(): HasMany
    {
        return $this->hasMany(ServiceGarbageContent::class)
            ->select('id', 'service_garbage_type_id', 'service_garbage_id', 'content', 'active', 'created_at');
    }

    public function scopeWithServiceType($query)
    {
        return $query->with("serviceGarbageContents.serviceGarbageType:id,name,icon,description,active,created_at");
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
}
