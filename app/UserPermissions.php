<?php

namespace App;

enum UserPermissions: string
{
    case DeleteUser = 'delete-user';
    case DisableUser = 'disable-user';
    case ActivateUser = 'activate-user';
}
