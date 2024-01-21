<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNotification;

class SubscribeController extends Controller
{
    public function subscribe(Request $request)
    {
        // Assuming you have a logged-in user, you can get the user ID like this:
        $userId = auth()->id();

        $details=[
            'title'=>"ini adalah title di subscribe controller",
            "message"=>"ini adalah message",
        ];
        Mail::to("paikahkahkah@gmail.com")->send(new EmailNotification($details));

        // Subscription successful
        return response()->json(['message' => 'Subscription successful']);
    }


}
