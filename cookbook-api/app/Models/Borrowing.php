<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
    'user_id',
    'copy_id',
    'borrowed_at',
    'returned_at'
    ];
    public function copy(){
        return $this->belongsTo(Copy::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
