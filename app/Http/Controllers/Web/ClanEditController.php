<?php

namespace App\Http\Controllers\Web;

use App\Models\ClanRank;
use App\Models\User;
use App\Models\Clan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ClanEditController extends Controller
{
    public function edit($id)
    {
        $clan = Clan::findOrFail($id);

        if (Auth::user()->id !== $clan->owner_id) {
            abort(403);
        }

        return view('web.clans.edit')->with([
            'clan' => $clan,
        ]);
    }

    public function updateDescription(Request $request, $id)
    {
        $clan = Clan::findOrFail($id);

        if (Auth::user()->id !== $clan->owner_id) {
            abort(403);
        }

        // make sure its not any more than 2000 chars
        $this->validate(
            $request,
            ['description' => 'max:2000',],['description.max' => 'Description cannot be greater than 2000 characters.',]
        );

        // updates description
        $clan->description = $request->input('description');
        $clan->save();

        return redirect()
            ->route('clans.edit', ['id' => $clan->id])
            ->with('success_message', 'Description updated')
            ->withInput(['description' => $request->input('description')]);
    }

    public function transferOwnership(Request $request, $id)
{
    $clan = Clan::findOrFail($id);
    $user = Auth::user();
    $username = $request->input('username');

    if ($user->id !== $clan->owner_id) {
        abort(403);
    }

    $newOwner = User::where('username', $username)->first();

    // check if the new owner is in the clan, if not, show an error.
    if (!$newOwner || !$newOwner->isInClan($clan->id)) {
        return back()->withErrors(["$username is not in the clan!"]);
    }
// im too lazy to make this a model, so it's here.
    \DB::beginTransaction();

    try {
        \DB::table('clan_members')
            ->where('clan_id', $clan->id)
            ->where('user_id', $user->id)
            ->update(['rank' => 1]);

        \DB::table('clan_members')
            ->where('clan_id', $clan->id)
            ->where('user_id', $newOwner->id)
            ->update(['rank' => 100]);

        $clan->owner_id = $newOwner->id;
        $clan->save();

        \DB::commit();

        return redirect()
            ->route('clans.view', ['id' => $clan->id])
            ->with('success_message', 'Transferred ownership to ' . $username);
    } catch (\Exception $e) {
        \DB::rollback();
        return back()->withErrors('An error occurred while transferring ownership.');
    }
}

    public function editThumbnail(Request $request, $id)
    {
        $clan = Clan::findOrFail($id);

        // you are not the owner so fuck off
        if (Auth::user()->id !== $clan->owner_id) {
            abort(403);
        }

        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $image = $request->file('image');
        $filename = Str::random(50); // generate the file name just like the create
         
        // make 150x150 and it will move to the storage
        $img = Image::make($image)
            ->fit(150, 150)
            ->encode('png');
        Storage::put("thumbnails/clans/{$filename}.png", $img);

        // set thumbnail to pending
        $clan->is_thumbnail_pending = 1;
        $clan->thumbnail = $filename;
        $clan->save();

        return redirect()
            ->route('clans.edit', ['id' => $clan->id])
            ->with('success_message', 'Clan thumbnail has been updated.');
    }

public function createNewRank(Request $request, $id)
{
    $clan = Clan::findOrFail($id);

    if (Auth::user()->id !== $clan->owner_id) {
        abort(403);
    }

    if (Auth::user()->currency_bucks < 6) {
        return back()->withErrors("You need atleast 6 bucks to make a new rank");
    }

    $lowestRank = ClanRank::where('clan_id', $clan->id)->min('rank');
    $nextRank = $lowestRank + 1;

    $this->validate($request, [
        'new_rank_name' => 'required|string|max:255',
    ]);

    ClanRank::create([
        'clan_id' => $clan->id,
        'name' => $request->input('new_rank_name'),
        'rank' => $nextRank,
        'can_post_wall' => 0,
        'can_moderate_wall' => 0,
        'can_invite_users' => 0,
        'can_manage_relations' => 0,
        'can_rank_members' => 0,
        'can_manage_ranks' => 0,
        'can_edit_description' => 0,
        'can_post_shout' => 0,
        'can_add_funds' => 0,
        'can_take_funds' => 0,
        'can_edit_clan' => 0,
    ]);

    Auth::user()->decrement('currency_bucks', 6);

    return back()->with('success_message', 'Rank ' . $request->input('new_rank_name') . ' created.');
}

}