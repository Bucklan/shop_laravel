<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $fillable = [
      'name',
      'email',
      'password',
      'role_id',
      'is_active',
      'my_balance',
      'image',
    ];
    protected $hidden = [
        'password',
        'remember_token',
];
    public function shop(){
        return $this->hasMany(Shop::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function shopsRated()
    {
        return $this->belongsToMany(Shop::class, 'rating')
            ->withPivot('rating')
            ->withTimestamps();
    }
    public function shopsBought(){
        return $this->belongsToMany(Shop::class,'cart')
            ->withTimestamps()
            ->withPivot('status','number');
    }
    public function shopsWithStatus($status){
        return $this->belongsToMany(Shop::class,'cart')
            ->wherePivot('status',$status)->withTimestamps()
            ->withPivot('status','number')
            ->using(Cart::class);
    }
}
