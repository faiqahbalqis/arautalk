<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index() {
        // Get all categories (tukar to topic/post later on)
        $categories = Category::all();
        $user = Auth::user();
    
        // Get the IDs of the categories the user has joined
        $joinedCategories = $user->forums()->pluck('category_id')->toArray();
        return view('user.home', compact('categories', 'joinedCategories'));
    }

    

    public function show(Forum $forum) {
        // Get the forum details and related topics
        
        //return view('user.topic', compact('forum'));
    }
}
