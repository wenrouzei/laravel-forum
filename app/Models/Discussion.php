<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'last_user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function lastReplyUser()
    {
        return $this->belongsTo(User::class, 'last_reply_user_id');
    }

    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return  $query->where(function ($query) use ($search) {
            $query->where('title', 'LIKE', "%$search%");
        });
    }
}
