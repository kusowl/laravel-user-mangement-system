<?php

namespace App;

enum UserStatus: string
{
    case Active = 'true';
    case Disabled = 'false';
}
