<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class ConversationMember extends Model
{
    /** @use HasFactory<\Database\Factories\ConversationMemberFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'conversation_id',
        'user_id',
        'role',
        'nickname',
        'is_muted',
        'muted_until',
        'is_pinned',
        'unread_count',
        'last_read_at',
        'last_read_message_id',
        'joined_at',
        'left_at',
        'invited_by',
    ];

    protected function casts(): array
    {
        return [
            'unread_count' => 'integer',
            'muted_until' => 'datetime',
            'last_read_at' => 'datetime',
            'joined_at' => 'datetime',
            'left_at' => 'datetime',
            'last_read_message_id' => 'integer',
            'invited_by' => 'integer',
        ];
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lastReadMessage(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'last_read_message_id');
    }

    public function inviter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_by');
    }
}
