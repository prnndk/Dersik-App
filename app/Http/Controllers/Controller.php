<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NotifyBot;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Notification;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function notifyBot(string $message): void
    {
        Notification::send(User::first(), new NotifyBot($message));
    }
}
