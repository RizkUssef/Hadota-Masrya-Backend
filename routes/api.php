<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\BlockedUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ConversationMemberController;
use App\Http\Controllers\MediaFileController;
use App\Http\Controllers\MessageAttachmentController;
use App\Http\Controllers\MessageReactionController;
use App\Http\Controllers\MessageReadController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// add(BlockedUser):create all crud files for the BlockedUser using command api-crud:make from laravel-crud-api packages that i make 

Route::apiResource('users', UserController::class);
Route::apiResource('messages', MessageController::class);
Route::apiResource('blocked-users', BlockedUserController::class);
Route::apiResource('contacts', ContactController::class);
Route::apiResource('conversations', ConversationController::class);
Route::apiResource('conversation-members', ConversationMemberController::class);
Route::apiResource('media-files', MediaFileController::class);
Route::apiResource('message-attachments', MessageAttachmentController::class);
Route::apiResource('message-reactions', MessageReactionController::class);
Route::apiResource('message-reads', MessageReadController::class);
