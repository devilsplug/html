@extends('layouts.default', [
    'title' => 'Edit Clan',
])

@section('content')
    <div class="col-10-12 push-1-12">
        <div class="tabs">
            <meta name="clan_id" content="8302">
            <div class="tab col-1-2 active" data-tab="1">
                Edit Clan
            </div>
            <div class="tab col-1-2" data-tab="2">
                Members &amp; Relations (Soon)
            </div>
            <div class="tab-holder">
                <div class="tab-body active" data-tab="1">
                    <div class="content p2">
                        <h1 style="font-size: 23px; margin-top: 0;">Edit {{ $clan->name }}</h1>
                        <div class="flex-container">
                            <div class="clan-edit-icon clan-edit col-3-12">
                                <div class="bold">Change Icon</div>
                                @if ($clan->is_thumbnail_pending)
                                    <img src="https://cdn.retro-hill.com/default/pending.png"
                                        style="width: 150px; height: 150px;">
                                @else
                                    <img src="https://cdn.retro-hill.com/thumbnails/clans/{{ $clan->thumbnail }}.png"
                                        style="width: 150px; height: 150px;">
                                @endif
                                <form method="POST" action="{{ route('clans.edit-thumbnail', ['id' => $clan->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input class="upload-input" type="file" name="image"
                                        style="border: 0; padding-left: 0;" required="">
                                    <input class="button blue upload-submit" type="submit" value="UPLOAD">
                                </form>
                            </div>
                            <div class="clan-edit-description clan-edit col-9-12">
                                <div class="bold">Update Description</div>
                                <form method="POST" action="{{ route('clans.update-description', ['id' => $clan->id]) }}"
                                    style="height: 65%;">
                                    @csrf
                                    <input type="hidden" name="type" value="description">
                                    <input type="hidden" name="clan_id" value="{{ $clan->id }}">
                                    <textarea class="upload-input" name="description" style="width: 90%; height: 100%;">{{ $clan->description }}</textarea>
                                    <input class="button blue upload-submit" type="submit" value="SAVE">
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="clan-edit-ranks overflow-auto">
                            <div class="bold">Edit Ranks</div>
                            <form method="POST" action="https://www.brick-hill.com/clan/edit">
                                <input type="hidden" name="_token" value="Roj2dcPggYNvGpDDIAmommmDTBsemfKxw47W8diS">
                                <input type="hidden" name="type" value="edit_ranks">
                                <input type="hidden" name="clan_id" value="8302">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h5>Power</h5>
                                            </td>
                                            <td>
                                                <h5>Name</h5>
                                            </td>
                                        </tr>
                                        @php
                                            $ranksFromDB = \App\Models\ClanRank::where('clan_id', $clan->id)->get();
                                        @endphp

                                        @php
                                            $sortedRanks = $ranksFromDB->sortBy('rank');
                                        @endphp

                                        @foreach ($sortedRanks as $rank)
                                            <tr>
                                                <td><input min="1" max="99" type="number"
                                                        name="rank{{ $rank->rank }}power" value="{{ $rank->rank }}">
                                                </td>
                                                <td><input type="text" name="rank{{ $rank->rank }}name"
                                                        value="{{ $rank->name }}"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <input class="button blue upload-submit" type="submit" value="SAVE">
                            </form>
                        </div>
                        <hr>
                        <div class="clan-new-rank clan-edit overflow-auto">
                            <div class="bold">New Rank</div>
                            <form method="POST" action="{{ route('clans.create-new-rank', ['id' => $clan->id]) }}">
                                @csrf
                                <input type="text" name="new_rank_name" placeholder="Rank name" required>
                                <div class="bucks-text bold">This will cost <span class="bucks-icon"></span>6</div>
                                <input class="button blue upload-submit" type="submit" value="CREATE">
                            </form>
                        </div>
                        <hr>
                        <div class="clan-change-owner overflow-auto clan-edit">
                            <div class="bold">Ownership</div>
                            <form method="POST" action="{{ route('clans.transfer-ownership', ['id' => $clan->id]) }}">
                                @csrf
                                <input type="hidden" name="type" value="ownership">
                                <input type="text" name="username" placeholder="Username">
                                <div class="red-text bold">User must be in clan to be given ownership</div>
                                <input class="button blue upload-submit" type="submit" value="TRANSFER">
                            </form>
                        </div>
                        <hr>
                        <div class="clan-change-owner clan-edit">
                            <div class="bold">Abandon</div>
                            <input type="hidden" name="type" value="abandon">
                            <input type="hidden" name="clan_id" value="8302">
                            <input class="button red upload-submit" type="submit" value="ABANDON" disabled>
                            <div class="red-text bold">This is being added, it's not up yet.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection