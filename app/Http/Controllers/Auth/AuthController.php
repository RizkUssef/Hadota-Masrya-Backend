<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rizkussef\LaravelCrudApi\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;
    public function me(Request $request)
    {
        return $this->success($request->user());
    }

    public function logout()
    {
        Auth::logout();
        return $this->success(null, 'Logged out successfully');
    }
}
