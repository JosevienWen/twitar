<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\users;

class tweets extends Model
{
    use HasFactory;

    protected $table = 'tweets';
    protected $fillable = [
        'id',
        'tweets',
        'user_id',
        'media',
        'tags'
    ];

    //function untuk merelasikan table tweets dan users
    public function user()
    {
        return $this->hasOne(users::class, 'id', 'user_id');
    }

    //function untuk merelasikan table tweets dan users
    public function comments()
    {
        return $this->hasMany(comments::class, 'tweet_id', 'id')->latest();
    }
}
