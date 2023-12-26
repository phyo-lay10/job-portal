<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->get();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = NewsCategory::all();
        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        $image = $request->image;
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->storeAs('public/news-images', $imageName);
        $data['image'] = $imageName;

        News::create($data);
        return redirect()->route('news.index')->with('success', 'You have successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comments = Comment::where('news_id', $id)->get();
        return view('admin.news.comment', compact('comments'));
    }

    public function showHideComment($id)
    {
        $comment = Comment::findOrfail($id);

        // if ($comment->status == 'show') {
        //     $comment->update([
        //         'status' => 'hide'
        //     ]);
        // } else {
        //     $comment->update([
        //         'status' => 'show'
        //     ]);
        // }

        $status = $comment->status == 'show' ? 'hide' : 'show';
        $comment->update([
            'status' => $status,
        ]);
        return back()->with('success', 'Comment status has changed successfully!');
    }

    public function deleteComment($id)
    {
        Comment::find($id)->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $new = News::find($id);
        $categories = NewsCategory::all();
        return view('admin.news.edit', compact('new', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->validateRequest($request);

        $new = News::find($id);
        $newImage = $new->image;

        if ($request->image) {
            File::delete('storage/news-images/' . $newImage);

            $image = $request->image;
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/news-images', $imageName);
            $data['image'] = $imageName;
        }

        $new->update($data);
        return redirect()->route('news.index')->with('success', 'You have successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $new = News::find($id)->delete();
        return back()->with('success', 'You have successfully deleted!');
    }

    private function validateRequest(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'news_category_id' => 'required',
        ];

        if ($request->isMethod('put') || $request->isMethod('patch')) {
            $rules['image'] = 'nullable|image|mimes:jpg,jpeg,png';
        }

        return $request->validate($rules);
    }
}
