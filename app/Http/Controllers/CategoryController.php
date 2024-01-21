<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Forum;

class CategoryController extends Controller
{

    public function index()
    {
        //latest(): view based on timestamps, latest categories will appear first
        //paginate(20): each page display 20 categories
        $categories = Category::latest()->paginate(20);
        return view('admin.pages.categories', \compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.new_category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required',
            'desc' => 'required'
        ]);
        $category = new Category;
        $category->title = $request->title;
        $category->desc = $request->desc;
        $category->user_id = auth()->id();
        $category->save();
        Session::flash('message', 'New category has been created successfully.');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

    public function show(string $id)
    {
        $category = Category::find($id);
        return view('admin.pages.show_category', \compact("category"));
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.pages.edit_category', \compact("category"));
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if ($request->title) {
            $category->title = $request->title;
        }
        if ($request->desc) {
            $category->desc = $request->desc;
        }
        
        $category->save();
        Session::flash('message', 'Category updated successfully.');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

    public function destroy(string $id)
    {
        $category = Category::find($id); 
        $category->delete();
        Session::flash('message', 'Category deleted successfully.');
        Session::flash('alert-class', 'alert-success');
        return back();
    }

    public function home()
    {
        $categories = Category::all();
        return view('home', compact('categories'));
    }

    public function join(Category $category)
    {
        $user = Auth::user();

        // Check if the user has already joined the category
        $alreadyJoined = Forum::where('user_id', $user->id)
        ->where('category_id', $category->id)
        ->exists();

        if (!$alreadyJoined) {
            // Create a new forum record
            $forum = new Forum([
                'user_id' => $user->id,
                'category_id' => $category->id,
            ]);
            $forum->save();
        }

        return redirect()->route('user.topicoverview', ['category' => $category]);
    }

}