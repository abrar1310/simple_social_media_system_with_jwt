<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'the_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'the_id', 'id');
    }
}
