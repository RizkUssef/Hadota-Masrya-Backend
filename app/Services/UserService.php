<?php

namespace App\Services;

use App\Models\User;
use Rizkussef\LaravelCrudApi\Services\ApiCrudService;

class UserService extends ApiCrudService
{
    protected function model(): string
    {
        return User::class;
    }
}