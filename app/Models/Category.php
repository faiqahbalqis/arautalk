<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'user_id',
        'title',
        'desc',
        'is_deleted',
    ];

    public function forums(): HasMany
    {
        return $this->hasMany(Forum::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
