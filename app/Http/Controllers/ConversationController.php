<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\ConversationService;

class ConversationController extends ApiCrudController
{
    public function __construct(ConversationService $service)
    {
        parent::__construct($service);
    }
}
