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
        $comment['user_id'] = auth()->user()->id;

        return $this->comments()->create($comment);
    }
}
