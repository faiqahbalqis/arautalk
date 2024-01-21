<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Reply;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::paginate(10);
        return view('admin.pages.reports', compact('reports'));
    }

    public function submitReport(Request $request, $topic_id = null, $reply_id = null)
    {
        // Get the report data from the request
        $reason = $request->input('reason');
        $otherReason = $request->input('otherReason');
        $userId = auth()->user()->id;

        // Create a new report instance
        $report = new Report();
        $report->reason = $reason;
        $report->other_reason = $otherReason;
        $report->user_id = $userId;

        // Assign the topic or reply ID based on the parameters
        if ($topic_id) {
            $report->topic_id = $topic_id;
            $report->reply_id = $reply_id;
            $topic = Topic::findOrFail($topic_id);
            $report->category_id = $topic->category_id;
        } elseif ($reply_id) {
            $report->reply_id = $reply_id;
            $reply = Reply::findOrFail($reply_id);
            $report->category_id = $reply->topic->category_id;
        }

        // Save to database
        $report->save();

        return response()->json(['success' => true]);

    }
}
