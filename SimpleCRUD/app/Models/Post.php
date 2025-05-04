<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'title', 'detail'];

    // User モデルとのリレーションを定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}