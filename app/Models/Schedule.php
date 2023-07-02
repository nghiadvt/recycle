<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Area;
use App\Models\GarbageTypeSchedule;
use App\Models\Scopes\DecreaseWithIDScope;
use App\Models\GarbageTitle;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\FilterableTrait;

class Schedule extends Model
{
    use HasFactory;
    use FilterableTrait;

    const NAME = 'schedule';
    const COLUMNS = ['id', 'date_start_at', 'date_end_at', 'time_start_at', 'time_end_at', 'active', 'day_of_week', 'is_repeat', 'area_id', 'created_at'];
    const ACTIVE = 1;
    const NO_ACTIVE = 0;

    public $timestamp = true;

    protected $with = ['area'];
    protected $fillable = [
        'date_start_at',
        'date_end_at',
        'time_start_at',
        'time_end_at',
        'active',
        'day_of_week',
        'is_repeat',
        'area_id',
    ];
    protected $appends = ['day_status', 'day'];
    protected $casts = [
        'day_of_week' => 'integer',
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class)->select(
            'id',
            'zip_no',
            'zip_no_address',
            'address_no',
            'address',
            'active',
            'created_at'
        );
    }

    public function garbageTypeSchedules(): HasMany
    {
        return $this->hasMany(GarbageTypeSchedule::class, 'schedule_id', 'id');
    }

    public function garbageTitles(): HasMany
    {
        return $this->hasMany(GarbageTitle::class, 'schedule_id', 'id')->select(
            'id',
            'image',
            'title',
            'description',
            'schedule_id',
            'garbage_type_id',
            'created_at'
        );
    }

    public function scopeWithGarbageType($query)
    {
        return $query->with(
            'garbageTypeSchedules.garbageType:id,name,active,icon,description'
        );
    }

    public function getDayStatusAttribute()
    {
        return $this->is_repeat ? 'Repeat' : 'No-Repeat';
    }

    public function getDayAttribute()
    {
        $daysOfWeek = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thurday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday',
        ];
        $dayOfWeek = isset($daysOfWeek[$this->day_of_week])
            ? $daysOfWeek[$this->day_of_week]
            : '';

        return $dayOfWeek;
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new DecreaseWithIDScope());
    }

    /**
     * Scope a query to only include active.
     */
    public function scopeActive(Builder $query, $type = self::ACTIVE): void
    {
        $query->where('active', $type);
    }
}
