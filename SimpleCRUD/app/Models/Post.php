<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [Constants::POST_COLUMN_USER_ID, Constants::POST_COLUMN_TITLE, Constants::POST_COLUMN_DETAIL];

    // User モデルとのリレーションを定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}