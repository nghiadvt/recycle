<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ServiceGarbageContent;

class ServiceGarbageType extends Model
{
    use HasFactory;

    const COLUMNS = ['id', 'name', 'icon', 'description', 'active', 'created_at'];
    const NAME = 'service garbage type';

    protected $fillable = ['title', 'icon', 'description', 'active'];

    /**
     * Get the serviceGarbageContent for the blog serviceGarbageType.
     */
    public function serviceGarbageContents(): HasMany
    {
        return $this->hasMany(ServiceGarbageContent::class);
    }
}
