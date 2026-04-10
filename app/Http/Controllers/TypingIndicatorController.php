<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\TypingIndicatorService;

class TypingIndicatorController extends ApiCrudController
{
    public function __construct(TypingIndicatorService $service)
    {
        parent::__construct($service);
    }
}
