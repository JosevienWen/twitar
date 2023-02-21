<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = [
        'id',
        'comment',
        'media',
        'tags',
        'tweet_id',
        'user_id',
    ];
    
    //function untuk merelasikan table comments dan user
    public function user()
    {
        return $this->hasOne(users::class, 'id', 'user_id');
    }
}
