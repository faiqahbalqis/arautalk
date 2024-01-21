<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\TelegramNotification;

class PostReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'reply',
        'topic_id',
        'user_id',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
