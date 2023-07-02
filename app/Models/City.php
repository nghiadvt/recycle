<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const INACTIVE = 0;
    const NAME = 'cities';
    const COLUMNS = ['id', 'city_no', 'name', 'pref_id', 'pref_no', 'active'];

    protected $fillable = [
        'city_no',
        'name',
        'pref_id',
        'pref_no',
        'active',
        'order'
    ];

    protected $hidden = [
        'updated_at'
    ];

    /**
     *
     *
     * @return HasMany
     */
    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
    }

    /**
     *
     *
     * @return BelongsTo
     */
    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class);
    }
}
