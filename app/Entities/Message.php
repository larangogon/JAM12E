<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Message extends Model
{
    protected $table = 'messages';

    protected $guarded = ['id'];

    protected $fillable = [
        'id',
        'recipient_id',
        'body',
        'sender_id'
    ];

    /**
     * @return BelongsTo
     */
    public function recipientId(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * @return BelongsTo
     */
    public function senderId(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * @return mixed
     */
    public function getCacheMessages()
    {
        return Cache::remember('messages', now()->addDay(), function () {
            return $this->all();
        });
    }
}
