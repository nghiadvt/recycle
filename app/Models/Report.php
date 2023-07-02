<?php

namespace App\Models;

use App\Models\ContainerGarbageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    use HasFactory;

    const NAME = "Report";

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email_address',
        'phone_number',
        'area_id',
        'account',
    ];

    protected $hidden = [
        'updated_at'
    ];

    /**
     *
     *
     * @return HasMany
     */
    public function missend_reports(): HasMany
    {
        return $this->hasMany(MissendReport::class);
    }

    /**
     * method container_garbage_types
     *
     * @return HasMany
     */
    public function container_garbage_types(): HasMany
    {
        return $this->hasMany(ContainerGarbageType::class);
    }
}
