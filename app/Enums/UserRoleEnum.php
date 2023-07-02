<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case Admin = 0;
    case Buyer = 1;
    case Seller = 2;
}
