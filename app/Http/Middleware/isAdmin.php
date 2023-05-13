<?php

namespace App\Http\Middleware;

use App\Notifications\NotifyBot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, \Closure $next)
    {
        if (auth()->guest() || auth()->user()->role !== 'admin') {
            Notification::send(auth()->user(), new NotifyBot('Upaya Akses Halaman 403 oleh *'.auth()->user()->name.'* pada halaman /'.$request->path()));
            abort(403);
        }

        return $next($request);
    }
}
