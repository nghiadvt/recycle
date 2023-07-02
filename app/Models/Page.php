<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DecreaseWithIDScope;
use Illuminate\Database\Eloquent\Builder;

class Page extends Model
{
    use HasFactory;

    const NONE = 1;
    const TERMS_OF_SERVICE = 2;
    const PRIVACY_POLICY = 3;
    const COLUMNS = ['id', 'title', 'content', 'type', 'slug', 'description', 'active', 'created_at', 'updated_at'];
    const TERM_NAME = 'terms of service';
    const PRIVACY_NAME = 'privacy policy';
    const NAME = 'item';
    const ACTIVE = 1;

    public $timestamp = true;

    protected $fillable = ['title', 'content', 'type', 'slug', 'description', 'active',];
    protected $casts = [
        'type' => 'integer'
    ];
    protected $appends = ['type_name'];

    public function getTypeNameAttribute()
    {
        $types = [
            1 => 'None',
            2 => 'Term of Service',
            3 => 'Privacy Policy',
        ];
        return isset($types[$this->type]) ? $types[$this->type] : '';
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new DecreaseWithIDScope());
    }

    /**
     * Scope a query to only include active users.
     */
    public function scopeActive(Builder $query, $type = self::ACTIVE): void
    {
        $query->where('active', $type);
    }
}
