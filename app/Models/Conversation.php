<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    /** @use HasFactory<\Database\Factories\ConversationFactory> */
    use HasFactory;

    protected $fillable = [
        'uuid',
        'type',
        'name',
        'description',
        'avatar_url',
        'created_by',
        'last_message_id',
        'last_activity_at',
        'is_archived',
    ];

    protected function casts(): array
    {
        return [
            'last_message_id' => 'integer',
            'last_activity_at' => 'datetime',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function lastMessage(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(ConversationMember::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function typingIndicators(): HasMany
    {
        return $this->hasMany(TypingIndicator::class);
    }
}
