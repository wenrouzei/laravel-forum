<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'discussion_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    /**
     * 获取该评论的所有点赞
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
