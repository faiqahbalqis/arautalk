<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Topic;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewReplyNotification;
use App\Notifications\TelegramNotification;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.pages.users', compact('users'));
    }

    


    public function show($id)
    {
        $user = User::find($id);
        return view('admin.pages.show_user', \compact("user"));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.pages.edit_user', \compact("user"));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->student_no) {
            $user->student_no = $request->student_no;
        }
        
        $user->save();
        return back()->with('message', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('message', 'User deleted successfully.');
    }

    public function block($id) {
        $user = User::findOrFail($id);
        $user->is_blocked = true;
        $user->save();

        return redirect()->back();
    }

    public function unblock($id) {
        $user = User::findOrFail($id);
        $user->is_blocked = false;
        $user->save();

        return redirect()->back();
    }

    public function getUserTotal() {
        $totalUsers = User::count();
        return view('admin.pages.user_total', compact('totalUsers'));
    }

    public function topicoverview(Category $category) {
        // Retrieve the topics for the specified category
        $topics = $category->topics;
        
        return view('user.topic-overview', compact('category', 'topics'));
    }

    public function topic(Category $category, Topic $topic)
    {       
        // Get the authenticated user
        $user = Auth::user();

        $category = Category::findOrFail($category->id);
        $topic = Topic::with('replies')->findOrFail($topic->id);
        $topic->load('replies.user'); // Eager load the replies and their associated users

        return view('user.topic', compact('category', 'topic', 'user'));
    }
}
