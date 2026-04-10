<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\MessageService;

class MessageController extends ApiCrudController
{
    public function __construct(MessageService $service)
    {
        parent::__construct($service);
    }
}
