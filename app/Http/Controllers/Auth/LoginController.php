<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Rizkussef\LaravelCrudApi\Traits\ApiResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (!Auth::attempt($credentials)) {
            return $this->error('Invalid credentials', 401);
        }
        $user = $request->user();
        return $this->success([
            'user' => $user,
        ], 'Login successful');
    }

}
