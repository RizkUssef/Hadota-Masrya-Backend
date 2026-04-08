<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSetting extends Model
{
    /** @use HasFactory<\Database\Factories\UserSettingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'theme',
        'language',
        'notification_sound',
        'notification_preview',
        'read_receipts',
        'typing_indicators',
        'online_status_visible',
        'two_factor_enabled',
        'two_factor_secret',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
