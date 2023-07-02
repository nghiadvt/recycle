<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MissendReport extends Model
{
    use HasFactory;

    const NAME = "Missend report collection";

    protected $fillable = [
        'report_id',
        'garbage_type',
        'description',
    ];

    protected $hidden = [
        'updated_at'
    ];

    /**
     *
     *
     * @return BeLongsTo
     */
    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}
