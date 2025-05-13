<?php

namespace App\Models;

use App\Models\User;
use App\Models\ForumThread;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumBookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'thread_id',
        'active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(ForumThread::class);
    }
}