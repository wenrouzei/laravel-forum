<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['likeable_id', 'likeable_type', 'user_id'];

    /**
     * 获取所属的likeable模型
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
