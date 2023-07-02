<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceGarbage;
use App\Models\ServiceGarbageType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceGarbageContent extends Model
{
    use HasFactory;

    protected $fillable = ['service_garbage_type_id', 'service_garbage_id', 'content', 'active'];

    /**
     * Get the garbageService that owns the serviceGarbageContent.
     */
    public function serviceGarbage(): BelongsTo
    {
        return $this->belongsTo(ServiceGarbage::class);
    }

    /**
     * Get the garbageServiceType that owns the serviceGarbageContent.
     */
    public function serviceGarbageType(): BelongsTo
    {
        return $this->belongsTo(ServiceGarbageType::class);
    }
}
