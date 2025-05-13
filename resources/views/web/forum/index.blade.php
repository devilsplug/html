@extends('layouts.default', [
    'title' => 'Forum'
])

@section('content')
    <div class="col-8-12">
        @include('web.forum._header')
    </div>
    <div class="col-8-12">
        @foreach (config('forum.sections') as $section)
            @if (Auth::check() && Auth::user()->isStaff() || $section['title'] != 'Admin')
                @component('components.topic-card', [
                    'topics' => $topics,
                    'title' => $section['title'],
                    'topicIds' => $section['topicIds'],
                    'cardColor' => $section['cardColor'],
                ])
                @endcomponent
            @endif
        @endforeach
    </div>
    <div class="col-4-12">
        <div class="card">
            <div class="top">Recent Topics</div>
            <div class="content">
                @foreach ($recentThreads as $key => $thread)
                    <div class="thread">
                        <div class="col-10-12 ellipsis">
                            <div class="ellipsis mb1">
                                <a href="{{ route('forum.thread', $thread->id) }}" class="label dark">{{ $thread->title }}</a>
                            </div>
                            <div class="label small ellipsis">
                                by <a href="{{ route('users.profile', $thread->creator->id) }}" class="dark-gray-text">{{ $thread->creator->username }}</a> in <a href="{{ route('forum.topic', $thread->topic->id) }}" class="dark-gray-text">{{ $thread->topic->name }}</a>
                            </div>
                        </div>
                        <div class="col-2-12">
                            <div class="forum-tag">{{ number_format($thread->replies(false)->count()) }}</div>
                        </div>
                    </div>

                    @if ($key != $recentThreads->count() - 1)
                        <hr>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="card">
            <div class="top">Popular Topics</div>
            <div class="content">
                coming soon, one I gave bh.net was shiiit and didn't use a component
            </div>
        </div>
    </div>
@endsection