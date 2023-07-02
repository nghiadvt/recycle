<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;
use App\Traits\FilterableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Area extends Model
{
    use HasFactory;
    use FilterableTrait;

    const ACTIVE = 1;
    const INACTIVE = 0;
    const ASC = 'asc';
    const DESC = 'desc';
    const NAME = 'area';
    const COLUMNS = ['id', 'zip_no', 'zip_no_address', 'pref_id', 'city_id', 'address_no', 'address', 'active'];

    protected $fillable = [
        'zip_no',
        'zip_no_address',
        'pref_id',
        'city_id',
        'address_no',
        'address',
        'active'
    ];

    protected $hidden = [
        'updated_at',
    ];
    protected $appends = ['addressZipcode'];

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * @return HasMany
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * @return BelongsTo
     */
    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class, 'pref_id');
    }

    // Create a full address;
    public function getAddressZipcodeAttribute()
    {
        return $this->zip_no . ' - ' . $this->address;
    }

    /**
     * Scope a query to only include active area.
     */
    public function scopeActive(Builder $query, $type = self::ACTIVE): void
    {
        $query->where('active', $type);
    }

    /**
     * Scope a query to only include active area.
     */
    public function scopeOrderByAddress(Builder $query, $type = self::ASC): void
    {
        $query->orderBy('address', $type);
    }
}
