<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportApp extends Model
{
    use HasFactory;

    const NAME = "Report problem app";

    protected $fillable = [
        'id',
        'email',
        'comment'
    ];

    protected $hidden = [
        'updated_at'
    ];
}
