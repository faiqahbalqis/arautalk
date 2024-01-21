<?php

namespace App\Http\Controllers;

use App\Notifications\TelegramNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TelegramController extends Controller
{
    public function triggerNotification(Request $request)
    {
        // Get all the subscribed users
        $subscribedUsers = \App\Models\Subscription::all();

        // Trigger the notification for each subscribed user
        Notification::send($subscribedUsers, new TelegramNotification());

        // Notification triggered successfully
        return response()->json(['message' => 'Notification sent successfully']);
    }
}
