<?php

namespace App\Models;

use App\Models\GarbageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ContainerGarbageType;
use App\Enum\DamagedMissingEnum;
use App\Models\Report;

class DamagedMissingReport extends Model
{
    use HasFactory;

    const NAME = "Damaged Missing Report";

    protected $fillable = [
        'type',
        'container_garbage_type_id',
        'report_id'
    ];

    protected $casts = [
        'type' => DamagedMissingEnum::class,
    ];

    protected $hidden = [
        'updated_at'
    ];

    /**
     *
     *
     * @return BelongsTo
     */
    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    /**
     *
     *
     * @return BelongsTo
     */
    public function containerGarbageType(): BelongsTo
    {
        return $this->belongsTo(ContainerGarbageType::class);
    }
}
