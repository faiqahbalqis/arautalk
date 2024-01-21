<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'post', 
        'category_id', 
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function replies()
    {
        return $this->hasMany(PostReply::class, 'topic_id');
    }

    public function subscribedUsers()
{
    return $this->belongsToMany(User::class, 'subscriptions');
}

}
