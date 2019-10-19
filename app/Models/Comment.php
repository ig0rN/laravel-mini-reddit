<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Commentable;

class Comment extends Model
{
    use Commentable;

    protected $guarded  = ['id'];
    protected $with     = ['comments'];

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function delete()
    {
        $x = parent::delete();

        if($x == true) {
            $relations = $this->comments;
            
            foreach($relations as $relation){
                $relation->delete();
            }
        }
    }
}
