<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\UserRoleEnum;

class User extends Model
{
    use HasFactory;
    const Admin = 0;
    const Buyer = 1;
    const Seller = 2;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'role',
    ];
    protected $casts = [
        'role' => UserRoleEnum::class
    ];
    protected $hidden = [
        'updated_at',
    ];
}
