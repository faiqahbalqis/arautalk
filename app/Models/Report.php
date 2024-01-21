<?php

namespace App\Models;
use App\Models\Post;
use App\Models\Reply;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
