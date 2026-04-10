<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\PushTokenService;

class PushTokenController extends ApiCrudController
{
    public function __construct(PushTokenService $service)
    {
        parent::__construct($service);
    }
}
