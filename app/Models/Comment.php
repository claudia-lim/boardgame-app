<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment', 'boardgame_id', 'public', 'user_id'
    ];

    public function user($id) {
        return User::where('id', $id)->get()->first();

    }
}
