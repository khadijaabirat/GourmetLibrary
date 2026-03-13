<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    protected $fillable = [
        'book_id',
        'reference_code',
        'status',
        'damage_details'
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function borrowings(){
        return $this->hasMany(Borrowing::class);
    }

}
