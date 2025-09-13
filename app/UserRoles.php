<?php

namespace App;

enum UserRoles: string
{
    case Admin = 'admin';
    case User = 'user';
}
