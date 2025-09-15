<?php

namespace App;

enum UserStatus: int
{
    case Active = 1;
    case Disabled = 0;
}
