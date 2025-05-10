<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'article_id',
        'user_id',
        'comment_reply_id',
    ];

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Comments::class, 'comment_reply_id', 'id')
        ->join('users', 'users.id', '=', 'comments.user_id')
        ->select('comments.*', 'users.name');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d M Y', strtotime($value));
    }
}
