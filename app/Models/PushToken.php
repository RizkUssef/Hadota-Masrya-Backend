<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PushToken extends Model
{
    /** @use HasFactory<\Database\Factories\PushTokenFactory> */
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'token',
        'platform',
        'device_name',
        'is_active',
        'last_used_at',
    ];

    protected function casts(): array
    {
        return [
            'last_used_at' => 'datetime',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
