<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\BlockedUserService;

class BlockedUserController extends ApiCrudController
{
    public function __construct(BlockedUserService $service)
    {
        parent::__construct($service);
    }
}
