<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    // protected $filed = ['user_id', 'content'];
    // protected $table = 'notes';

    public function user()
    {
        return $this->belongsTo(User::class, "users_id");
    }
}
