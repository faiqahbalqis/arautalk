<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Models\PostReply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Notifications\TelegramNotification;
use Notification;

class TopicController extends Controller
{
    protected $fillable = [
        'post', 
        'user_id', 
        'category_id'
    ];

    public function topics()
{
    $topics = Topic::paginate(10);
    return view('admin.pages.topics', compact('topics'));
}

public function replies()
{
    $replies = PostReply::paginate(10);
    return view('admin.pages.replies', compact('replies'));
}

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    public function newTopic(Category $category) {
        return view('user.new-topic', compact('category'));
    }

    public function viewTopic($id)
    {
        $topic = Topic::findOrFail($id);
        $reply = $topic->postReplies->first(); // Get the first reply of the topic

        return view('topic', compact('topic', 'reply'));
    }


    public function storeTopic(Request $request, Category $category) {
        $user = Auth::user();

        $request->validate([
            'post' => 'required',
        ]);

        $topic = new Topic([
            'post' => $request->post,
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);
        $topic->save();

        return redirect()->route('user.topicoverview', $category);
    }

    public function storeReply(Category $category, Topic $topic, Request $request)
    {
        $request->validate([
            'reply' => 'required',
        ]);

        $user = Auth::user();

        $reply = new PostReply([
            'reply' => $request->input('reply'),
            'user_id' => $user->id,
        ]);

        $topic->replies()->save($reply);

        return redirect()->route('user.topic', ['category' => $category->id, 'topic' => $topic->id]);
    }

    public function deleteTopic(Category $category, Topic $topic): RedirectResponse
    {
        // Check if the authenticated user is the author of the topic
        //if (auth()->id() != $topic->user->id) {
        //    return redirect()->back()->with('error', 'You are not authorized to delete this topic.');
        //}

        // Update the topic's post_deleted column
        $topic->post_deleted = true;
        $topic->save();

        return redirect()->route('user.topicoverview', ['category' => $category])->with('message', 'Topic deleted successfully.');
    }

    public function deleteReply(Category $category, Topic $topic, PostReply $reply): RedirectResponse
    {
        $reply->post_deleted = true;
        $reply->save();

        return redirect()->route('user.topic', ['category' => $category, 'topic' => $topic])->with('message', 'Reply deleted successfully.');
    }

}
