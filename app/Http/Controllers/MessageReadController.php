<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\MessageReadService;

class MessageReadController extends ApiCrudController
{
    public function __construct(MessageReadService $service)
    {
        parent::__construct($service);
    }
}
