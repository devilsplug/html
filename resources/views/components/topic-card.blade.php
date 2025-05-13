{{-- thank god for components, this makes the forum.index wayyyy neater --}}
<div class="card">
    <div class="top {{ $cardColor }}">
        <div class="col-7-12">{{ $title }}</div>
        <div class="no-mobile overflow-auto topic text-center">
            <div class="col-3-12 stat">Threads</div>
            <div class="col-3-12 stat">Replies</div>
            <div class="col-6-12"></div>
        </div>
    </div>
    <div class="content">
        @foreach ($topics as $topic)
            @if (in_array($topic->id, $topicIds))
                <div class="board-info mb1">
                    <div class="col-7-12 board">
                        <div><a href="{{ route('forum.topic', $topic->id) }}" class="label dark">{{ $topic->name }}</a></div>
                        <span class="label small">{{ $topic->description }}</span>
                    </div>
                    <div class="no-mobile overflow-auto board ellipsis" style="overflow:hidden;">
                        <div class="col-3-12 stat">
                            <span class="title">{{ number_format($topic->threads(false)->count()) }}</span>
                        </div>
                        <div class="col-3-12 stat">
                            <span class="title">{{ number_format(0) }}</span>
                        </div>
                        <div class="col-6-12 text-right ellipsis pt2" style="max-width:180px;">
                            @if ($topic->lastPost())
                                <a href="{{ route('forum.thread', $topic->lastPost()->id) }}" class="label dark">{{ $topic->lastPost()->title }}</a>
                                <br>
                                <span class="label small">{{ $topic->lastPost()->updated_at->diffForHumans() }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
