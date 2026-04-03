<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id')->nullable();
            $table->string('uuid');
            $table->string('username', 50);
            $table->string('email', 191);
            $table->string('phone', 20)->nullable();
            $table->string('password', 255);
            $table->string('display_name', 100);
            $table->string('avatar_url', 500)->nullable();
            $table->text('bio')->nullable();
            $table->string('status')->nullable()->default('ACTIVE');
            $table->string('is_online')->nullable()->default('FALSE');
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->index(['is_online', 'last_seen_at'], 'idx_users_online');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
