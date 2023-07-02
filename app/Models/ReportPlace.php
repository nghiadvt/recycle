<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPlace extends Model
{
    use HasFactory;

    const NAME = 'place report';

    protected $fillable = ['email', 'address', 'status', 'active'];
}
