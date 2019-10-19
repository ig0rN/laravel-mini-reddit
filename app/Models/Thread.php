<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Commentable;

class Thread extends Model
{
    use Commentable;

    protected $guarded  = ['id'];
    protected $with     = ['comments'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function canEdit()
    {
        return $this->created_at->diffInHours(Carbon::now()) >= 6 ? false : true;
    }
}
