<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiveDailyCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && strtotime(Auth::user()->next_currency_payout) < time()) {
            $user = Auth::user();
            
            // free user (aka u are a nigger and didn't give me money)
            $user->currency_bits += 10;
            
            // memberships per day (thanks for the money bbg)
            $membership = $user->membership_level;

            if ($membership === 'ace') {
                $user->currency_bucks += 20;
            } elseif ($membership === 'royal') {
                $user->currency_bucks += 70;
            }
            $user->next_currency_payout = Carbon::now()->addHours(24)->toDateTimeString();
            $user->save();
        }

        return $next($request);
    }
}