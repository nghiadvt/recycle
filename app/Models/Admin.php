<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    const GENDER_MAN = 1;
    const GENDER_GIRL = 2;
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'status',
    ];
}
