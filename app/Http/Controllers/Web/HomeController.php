<?php
/**
 * MIT License
 *
 * Copyright (c) 2021-2022 FoxxoSnoot
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace App\Http\Controllers\Web;

use App\Models\Item;
use App\Models\User;
use App\Models\Status;
use App\Models\Inventory;
use App\Models\ForumThread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        return view('web.home.index')->with([
            'totalUsers' => $totalUsers
        ]);
    }

    public function dashboard()
    {
        $friends = [];
        $updates = ForumThread::where([
            ['topic_id', '=', config('site.news_topic_id')],
            ['is_deleted', '=', false]
        ])->orderBy('created_at', 'DESC')->get()->take(5);

        foreach (Auth::user()->friends() as $friend)
            $friends[] = $friend->id;

        $statuses = Status::where([
            ['creator_id', '!=', Auth::user()->id],
            ['message', '!=', null]
        ])->whereIn('creator_id', $friends)->orderBy('created_at', 'DESC')->take(10)->get();

        return view('web.home.dashboard')->with([
            'updates' => $updates,
            'statuses' => $statuses
        ]);
    }

    public function status(Request $request)
    {
        $this->validate($request, [
            'message' => ['max:124']
        ]);

        if ($request->message != Auth::user()->status()) {
            $status = new Status;
            $status->creator_id = Auth::user()->id;
            $status->message = $request->message;
            $status->save();
        }

        return back()->with('success_message', 'Status has been changed.');
    }
}
