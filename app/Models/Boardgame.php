<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Boardgame extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'imageurl'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(BoardgameUser::class)
            ->withPivot('favourite', 'comments', 'custom_name')
            ->withTimestamps();
    }
}
