@extends('layouts.default', [
    'title' => 'Clans'
])

@section('content')
    <div class="col-10-12 push-1-12">
@auth
    {{-- im sick and fuckin tired of bugs so deal with it. im new to laravel and its fuckin me up, it stays here till i figure it out --}}
    @php
        $user_id = auth()->id();
        $clanMembers = DB::table('clan_members')
            ->where('user_id', $user_id)
            ->get();
    @endphp

    @if($clanMembers->count() > 0)
        <div class="card">
            <div class="top blue">My Clans</div>
            <div class="content" style="text-align:center;">
                <div class="carousel clans">
                    <div style="width:95%;margin-right:auto;margin-left:auto;overflow:hidden">
                        <ul style="max-height: 160px;">
                            @foreach($clanMembers as $clanMember)
                                @php
                                    $clan = DB::table('clans')
                                        ->where('id', $clanMember->clan_id)
                                        ->first();
                                @endphp

                                @if($clan)
                                    <li class="carousel li" data-iteration="1">
                                        <a href="/clans/{{ $clan->id }}/">
                                            <div class="profile-card">
                                                <img src="https://cdn.retro-hill.com/thumbnails/clans/{{ $clan->thumbnail }}.png">
                                                <span class="ellipsis">{{ $clan->name }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endauth

        <div class="card">
            <div class="top blue">Popular Clans</div>
            <div class="content">
                <div class="mb2 overflow-auto">
                    <form action="{{ route('clans.index') }}" method="GET">
                        <div class="col-9-12">
                            <input class="width-100 rigid" style="height:41px;" type="text" name="search" placeholder="Search">
                        </div>
                        <div class="col-3-12">
                            <div class="acc-1-2 np">
                                <button class="blue width-100" type="submit">Search</button>
                            </div>
                            @auth
                                <div class="acc-1-2 np">
                                    <a href="{{ route('clans.create') }}" class="button green width-100">Create</a>
                                </div>
                            @endauth
                        </div>
                    </form>
                </div>
                <div class="col-1-1" style="padding-right:0;">
                    @forelse ($clans as $clan)
                        <a href="{{ route('clans.view', $clan->id) }}">
                            <div class="hover-card clan">
                                <div class="clan-logo">
                                    <img class="width-100" src="{{ $clan->thumbnail() }}">
                                </div>
                                <div class="data ellipsis">
                                    <span class="clan-name bold mobile-col-1-2 ellipsis">{{ $clan->name }}</span>
                                    <span class="push-right">{{ number_format($clan->member_count) }} {{ ($clan->member_count == 1) ? 'Member' : 'Members' }}</span>
                                </div>
                                <div class="clan-description">{!! nl2br(e($clan->description)) !!}</div>
                            </div>
                        </a>
                        <hr>
                    @empty
                        <div style="text-align:center">
                            <span>No clans found</span>
                        </div>
                    @endforelse
                </div>
                <div class="pages">{{ $clans->onEachSide(1) }}</div>
            </div>
        </div>
    </div>
@endsection
