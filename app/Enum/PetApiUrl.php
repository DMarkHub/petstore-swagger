<?php

namespace App\Enum;

enum PetApiUrl: string
{
    case UploadImage = '/pet/%s/uploadImage';
    // case Update = '/pet';
    case Create = '/pet';
    case FindByStatus = '/pet/findByStatus%s';
    case FindById = '/pet/%s';
    // case UpdateById = '/pet/%s';
    // case Delete = '/pet/%s';
}