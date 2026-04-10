<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\MessageAttachmentService;

class MessageAttachmentController extends ApiCrudController
{
    public function __construct(MessageAttachmentService $service)
    {
        parent::__construct($service);
    }
}
