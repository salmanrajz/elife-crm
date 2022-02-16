<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
use Cache;
use Carbon\Carbon;

class LastSeenUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     return $next($request);
    // }
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $expireTime = Carbon::now()->addMinute(3); // keep online for 1 min
            Cache::put('is_online' . Auth::user()->id, true, $expireTime);

            //Last Seen
            User::where('id', Auth::user()->id)->update(['last_seen' => Carbon::now()]);
        }
        return $next($request);
    }
}
