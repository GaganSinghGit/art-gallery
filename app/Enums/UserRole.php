<?php

namespace App\Enums;

enum UserRole: string
{
    case Artist = 'artist';
    case Admin = 'admin';
}
