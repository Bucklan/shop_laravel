<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'title',
            'content_kz',
            'content_en',
            'content_ru',
            'image',
            'price',
            'category_id',
            'user_id',
        ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function usersBought()
    {
        return $this->belongsToMany(User::class, 'cart')
            ->withTimestamps()
            ->withPivot('status');
    }

    public function usersRated()
    {
        return $this->belongsToMany(User::class, 'rating')
            ->withPivot('rating')
            ->withTimestamps();
    }

    public function shopsWithStatus($status)
    {
        return $this->belongsToMany(User::class, 'cart')
            ->wherePivot('status', $status)
            ->withTimestamps()
            ->withPivot('status','number');
    }
}
