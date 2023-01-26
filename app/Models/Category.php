<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_kz',
        'name_en',
        'name_ru',
        'image',
    ];
    use HasFactory;
    public function shops(){
        return $this->hasMany(Shop::class);
    }
}
