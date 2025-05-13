@auth
    <div class="card forum-links inline">
        <div class="content">
            <div class="inline">
                @if (config('site.rules_thread_id'))
                    <a href="{{ route('forum.thread', config('site.rules_thread_id')) }}">Rules</a>
                    <span class="divide"></span>
                @endif
                <div class="inline">
                    <a href="#">Bookmarked</a>
                </div>
                <a href="{{ route('forum.my_posts') }}">My Posts</a>
                <a href="#">Drafts</a>
            </div>
        </div>
    </div>
@endauth
