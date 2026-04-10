<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\MessageReactionService;

class MessageReactionController extends ApiCrudController
{
    public function __construct(MessageReactionService $service)
    {
        parent::__construct($service);
    }
}
