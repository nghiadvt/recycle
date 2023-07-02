<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Schedule;
use App\Models\GarbageType;

class GarbageTypeSchedule extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'garbage_schedule';
    protected $fillable = ['schedule_id', 'garbage_type_id'];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    public function garbageType(): BelongsTo
    {
        return $this->belongsTo(GarbageType::class, 'garbage_type_id', 'id');
    }
}
