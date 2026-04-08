<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MediaFile extends Model
{
    /** @use HasFactory<\Database\Factories\MediaFileFactory> */
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'uuid',
        'uploaded_by',
        'disk',
        'path',
        'url',
        'type',
        'mime_type',
        'size',
        'hash',
        'width',
        'height',
        'duration',
        'is_processed',
    ];

    protected function casts(): array
    {
        return [
            'uploaded_by' => 'integer',
            'size' => 'integer',
            'width' => 'integer',
            'height' => 'integer',
            'duration' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function messageAttachments(): HasMany
    {
        return $this->hasMany(MessageAttachment::class);
    }
}
