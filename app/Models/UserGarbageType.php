<?php

namespace App\Models;

use App\Models\Account;
use App\Models\GarbageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserGarbageType extends Model
{
    use HasFactory;

    const NAME = "User Garbage Type";

    protected $fillable = [
        'weight'
    ];

    protected $hidden = [
        'updated_at'
    ];

    /**
     *
     *
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     *
     *
     * @return BelongsTo
     */
    public function garbage_type(): BelongsTo
    {
        return $this->belongsTo(GarbageType::class);
    }
}
