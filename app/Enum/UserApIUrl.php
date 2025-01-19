<?php

namespace App\Enum;

enum UserApIUrl: string
{
    case CreateWithList = '/user/createWithList';
    case User = '/user/%s';
    // case UpdateByUsername = '/user/%s';
    // case DeleteByUsername = '/user/%s';
    case Login = '/user/login';
    case Logout = '/user/logout';
    case CreateWithArray = '/user/createWithArray';
    case Create = '/user';
}