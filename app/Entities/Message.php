<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
