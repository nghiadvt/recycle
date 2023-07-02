<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DecreaseWithIDScope;

class Language extends Model
{
    use HasFactory;

    const NAME = 'language';
    const COLUMNS = ['id', 'code', 'name', 'created_at'];

    public $timestamp = true;

    protected $fillable = ['name', 'code'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new DecreaseWithIDScope());
    }
}
