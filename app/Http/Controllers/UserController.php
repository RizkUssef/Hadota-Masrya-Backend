<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;

class UserController extends ApiCrudController
{
    public function __construct(UserService $service)
    {
        parent::__construct($service);
    }
}
