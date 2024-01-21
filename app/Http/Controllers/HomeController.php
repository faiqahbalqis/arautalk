<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return view('admin.pages.home');
            } else {
                $categories = Category::all();
                return view('home', compact('categories'));
            }
        }

        return view('welcome');
    }
}
