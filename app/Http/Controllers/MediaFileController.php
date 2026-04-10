<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\MediaFileService;

class MediaFileController extends ApiCrudController
{
    public function __construct(MediaFileService $service)
    {
        parent::__construct($service);
    }
}
