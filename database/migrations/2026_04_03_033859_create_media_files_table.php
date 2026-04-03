<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media_files', function (Blueprint $table) {

            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('uploaded_by');
            $table->string('disk', 50)->nullable()->default('S3');
            $table->string('path', 1000);
            $table->string('url', 1000);
            $table->string('type');
            $table->string('mime_type', 127);
            $table->integer('size');
            $table->string('hash')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('duration')->nullable();
            $table->string('is_processed')->nullable()->default('FALSE');
            $table->timestamp('created_at')->nullable();
            $table->index('hash', 'idx_media_hash');
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_files');
    }
};
