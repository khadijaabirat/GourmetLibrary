<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Routing\Annotation\Route;

class Category extends Model
{
    protected $fillable = [
    'name',
    'slug',
    'description',
    ];

    public function books(){
        return $this->hasMany(Book::class);
    }
}
