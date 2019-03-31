<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'author',
        'email',
        'body',
        'status'
    ];

    public function replies()
    {
        return $this->hasMany('App\CommentReply');
    }
}
