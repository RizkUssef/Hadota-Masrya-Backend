<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\UserSettingService;

class UserSettingController extends ApiCrudController
{
    public function __construct(UserSettingService $service)
    {
        parent::__construct($service);
    }
}
