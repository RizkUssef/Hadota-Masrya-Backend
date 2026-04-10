<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\ContactService;

class ContactController extends ApiCrudController
{
    public function __construct(ContactService $service)
    {
        parent::__construct($service);
    }
}
