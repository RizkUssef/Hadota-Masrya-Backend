<?php

namespace App\Http\Controllers;

use Rizkussef\LaravelCrudApi\Http\Controllers\ApiCrudController;
use App\Services\ConversationMemberService;

class ConversationMemberController extends ApiCrudController
{
    public function __construct(ConversationMemberService $service)
    {
        parent::__construct($service);
    }
}
