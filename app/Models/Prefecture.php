<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prefecture extends Model
{
    use HasFactory;

    const NAME = "Prefecture";
    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $table = 'prefectures';

    protected $fillable = [
        'pref_no',
        'name',
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
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    /**
     *
     *
     * @return HasMany
     */
    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
    }
}
