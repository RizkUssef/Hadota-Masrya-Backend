<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('message_attachments', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('media_file_id')->nullable();
            $table->string('type');
            $table->string('url', 1000);
            $table->string('thumbnail_url', 1000)->nullable();
            $table->string('file_name', 255)->nullable();
            $table->integer('file_size')->nullable();
            $table->string('mime_type', 127)->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('duration')->nullable();
            $table->string('sort_order')->nullable()->default('0');
            $table->timestamp('created_at')->nullable();
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade')->onUpdate('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('message_attachments');
    }
};
