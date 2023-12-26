<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Job;
use App\Models\Message;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UiController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
        $categories = Category::all();
        return view("ui-panel.welcome", compact("jobs", "categories", ));
    }

    public function search(Request $request)
    {
        $searchData = $request->search;
        $categories = Category::all();
        $jobs = Job::where('title', 'like', '%' . $searchData . '%')->orWhere('description', 'like', '%' . $searchData . '%')->get();

        return view("ui-panel.welcome", compact("jobs", "categories"));
    }
    public function searchById($id = null)
    {
        $categories = Category::all();

        if ($id) {
            $jobs = Job::where('category_id', $id)->get();
        } else {
            $jobs = Job::all();
        }
        return view('ui-panel.welcome', compact('categories', 'jobs'));
    }

    public function profile()
    {
        // $jobs = Job::all();
        // $apps = Application::where('employee_id', $user->id)->get();
        $user = auth()->user();
        $messages = Message::where('employee_id', $user->id)->get();

        return view('ui-panel.profile', compact('user', 'messages'));
        // return view('ui-panel.profile', compact('apps', 'user', 'messages', 'jobs'));
    }

    public function news()
    {
        $news = News::latest()->get();
        $newsCategories = NewsCategory::all();
        return view('ui-panel.news.index', compact('news', 'newsCategories'));
    }

    public function newsDetail($id)
    {
        $new = News::find($id);
        $comments = Comment::where('news_id', $id)->where('status', 'show')->latest()->get();
        return view('ui-panel.news.detail', compact('new', 'comments'));
    }

    public function searchNews(Request $request)
    {
        $newsCategories = NewsCategory::all();
        $searchData = '%' . $request->search . '%';
        $news = News::where('title', 'like', $searchData)->orWhere('description', 'like', $searchData)->orWhereHas('category', function ($category) use ($searchData) {
            $category->where('name', 'like', $searchData);
        })->get();
        return view('ui-panel.news.index', compact('news', 'newsCategories'));
    }

    public function newsSearchById($id = null)
    {
        $newsCategories = NewsCategory::all();

        if ($id) {
            $news = News::where('news_category_id', $id)->get();
        } else {
            $news = News::all();
        }

        return view('ui-panel.news.index', compact('news', 'newsCategories'));
    }
    // public function profileUpdate(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image|mimes:png,jpg,jpeg',
    //     ]);

    //     $user = auth()->user(); 

    //     
    //     if ($user->image) {
    //         Storage::delete('public/images/' . $user->image);
    //     }

    //     // Upload and store the new image
    //     $image = $request->file('image');
    //     $imageName = uniqid() . '_' . $image->getClientOriginalName();
    //     $image->storeAs('public/images', $imageName);

    //     // Update the user's image
    //     $user->update([
    //         'image' => $imageName,
    //     ]);
    //     return redirect()->route("profile")->with("success", "Photo has uploaded successfully!");
    // 

}
