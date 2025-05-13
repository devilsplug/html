@extends('layouts.default', [
    'title' => 'My Posts'
])

// This is extremely messy due to me doing this a year back, this needs to be redone.

@section('content')
    <div class="col-10-12 push-1-12">
        <div class="col-8-12">
            @include('web.forum._header')
        </div>
    </div>
    <div class="col-10-12 push-1-12">
        <div class="forum-bar weight600" style="padding: 10px 5px 10px 0;">
            <a href="{{ route('forum.index') }}">Forum</a>
            <i class="fa fa-angle-double-right" style="font-size: 1rem;" aria-hidden="true"></i>
            <a href="{{ route('forum.my_posts') }}">My Posts</a>
        </div>
        <div class="card">
            <div class="top blue">
                <div class="col-7-12">My Posts</div>
                <div class="no-mobile overflow-auto topic text-center">
                    <div class="col-3-12 stat">Replies</div>
                    <div class="col-3-12 stat">Views</div>
                    <div class="col-5-12"></div>
                </div>
            </div>
            <div class="content" style="padding: 0px">
                @php
                    $combinedPosts = $createdThreads->merge($repliedThreads);
                    $combinedPosts = $combinedPosts->sortByDesc(function ($post) {
                        return $post->created_at;
                    });
                @endphp

                @foreach ($combinedPosts as $post)
                    <div class="hover-card m0 thread-card" style="{{ ($post->is_deleted) ? 'opacity:.5;' : '' }}">
                        <div class="col-7-12 topic ellipsis">
                            @if ($post->is_pinned)
                                <span class="thread-label blue">Pinned</span>
                            @endif
                            @if ($post->is_locked)
                                <span class="thread-label blue">Locked</span>
                            @endif
                            <a href="{{ route('forum.thread', $post->id) }}">
                                <span class="small-text label dark">{{ $post->title }}</span>
                            </a>
                            <br>
                            <span class="label smaller-text">By <a href="{{ route('users.profile', $post->creator->id) }}" class="darkest-gray-text">{{ $post->creator->username }}</a></span>
                        </div>
                        <div class="no-mobile overflow-auto topic">
                            <div class="col-3-12 pt2 stat center-text">
                                <span class="title">{{ number_format($post->replies(false)->count()) }}</span>
                            </div>
                            <div class="col-3-12 pt2 stat center-text">
                                <span class="title">{{ number_format($post->views()) }}</span>
                            </div>
                            <div class="col-6-12 post ellipsis text-right">
                                <span class="label dark small-text"></span>
                                @if ($post->lastReply())
                                    <span class="label dark small-text">{{ $post->lastReply()->created_at->diffForHumans() }}</span>
                                    <br>
                                    <span class="label dark-gray-text smaller-text">By <a href="{{ route('users.profile', $post->lastReply()->creator->username) }}" class="darkest-gray-text">{{ $post->lastReply()->creator->username }}</a></span>
                                @else
                                    <span class="label dark small-text">{{ $post->created_at->diffForHumans() }}</span>
                                    <br>
                                    <span class="label dark-gray-text smaller-text">By <a href="{{ route('users.profile', $post->creator->username) }}" class="darkest-gray-text">{{ $post->creator->username }}</a></span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
