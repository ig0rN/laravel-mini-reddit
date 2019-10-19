<?php

namespace App\Traits;

use App\Models\Comment;

trait Commentable
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commented');
    }

    public function addComment($comment)
    {
        return $this->comments()->create($comment);
    }
}
