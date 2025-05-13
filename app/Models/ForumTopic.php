<?php

namespace App\Models;

use App\Models\ForumThread;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class ForumTopic extends Model
{
    use HasFactory;

    protected $table = 'forum_topics';

    protected $fillable = [
        'name',
        'description',
        'home_page_priority',
        'is_staff_only_viewing',
        'is_staff_only_posting'
    ];

    public function threads($hasPagination = true)
    {
        if (Auth::check() && Auth::user()->isStaff())
            $threads = ForumThread::where('topic_id', '=', $this->id)->orderBy('is_pinned', 'DESC')->orderBy('updated_at', 'DESC');
        else
            $threads = ForumThread::where([
                ['topic_id', '=', $this->id],
                ['is_deleted', '=', false]
            ])->orderBy('is_pinned', 'DESC')->orderBy('updated_at', 'DESC');

        return ($hasPagination) ? $threads->paginate(15) : $threads->get();
    }

    public function lastPost()
    {
        return ForumThread::where([
            ['topic_id', '=', $this->id],
            ['is_deleted', '=', false]
        ])->orderBy('updated_at', 'DESC')->first();
    }

public function color()
{
    $id = $this->id;

    if (in_array($id, [1, 3, 4, 5, 8])) {
        return 'blue';
    } elseif (in_array($id, [2, 7, 9, 10, 11])) {
        return 'green';
    } elseif (in_array($id, [12, 13, 14])) {
        return 'orange';
    } elseif ($id === 15) {
        return 'red';
    } elseif ($id === 6) {
        return 'gray cc_cursor';
    } else {
        return 'default-color'; // debugging
    }
}
}
