<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NotifyBot;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
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

    public function successResponseWithData($data): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Berhasil Mengambil Data',
            'data' => $data,
        ]);
    }

    public function errorResponse($message, $error_code): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Telah terjadi error',
            'error_message' => $message,
        ], $error_code);
    }
}
