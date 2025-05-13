<?php

namespace App\Http\Controllers\Web;

use App\Models\ForumThread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyPostsController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return abort(403);
        }

        $createdThreads = ForumThread::where('creator_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $repliedThreads = ForumThread::whereIn('id', function ($query) {
            $query->select('thread_id')
                ->from('forum_replies')
                ->where('creator_id', Auth::user()->id);
        })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('web.forum.my_posts')->with([
            'createdThreads' => $createdThreads,
            'repliedThreads' => $repliedThreads,
        ]);
    }
}