<?php

namespace App\Enum;

enum PetApiUrl: string
{
    case UploadImage = '/pet/%s/uploadImage';
    case Create = '/pet';
    case Update = '/pet';
    case FindByStatus = '/pet/findByStatus%s';
    case FindById = '/pet/%s';
    case UpdateById = '/pet/%s';
    case Delete = '/pet/%s';
}