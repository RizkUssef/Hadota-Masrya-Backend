<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageAttachment extends Model
{
    /** @use HasFactory<\Database\Factories\MessageAttachmentFactory> */
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'message_id',
        'media_file_id',
        'type',
        'url',
        'thumbnail_url',
        'file_name',
        'file_size',
        'mime_type',
        'width',
        'height',
        'duration',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'media_file_id' => 'integer',
            'file_size' => 'integer',
            'width' => 'integer',
            'height' => 'integer',
            'duration' => 'integer',
            'sort_order' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }

    public function mediaFile(): BelongsTo
    {
        return $this->belongsTo(MediaFile::class);
    }
}
