<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\category;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ApplicationController extends Controller
{
    public function apply($id)
    {
        // if (!Auth::check()) {
        //     return redirect()->route('loginForm');
        // }
        $job = Job::findOrfail($id);
        return view('ui-panel.application', compact('job'));
    }

    public function store(Request $request)
    {

        // $existingEmail = Application::where('email', $request->email)
        //     ->where('employee_id', '!=', Auth::user()->id)
        //     ->exists();

        // if ($existingEmail) {
        //     return redirect()->back()->withErrors(['email' => 'The email has already been taken brother.']);
        // }

        $request->validate([
            'name' => "required",
            'email' => "required|email|unique:applications|max:100",
            'address' => "required",
            'phone' => "required|numeric",
            'salary' => "required|numeric",
            'gender' => "required",
            'image' => "required|image|mimes:png,jep,jpeg",
            'job_id' => "required",
            'employee_id' => "required",
        ]);

        $image = $request->image;
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->storeAs('public/form-images', $imageName);

        $app = Application::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'salary' => $request->salary,
            'job_id' => $request->job_id,
            'employee_id' => $request->employee_id,
            'gender' => $request->gender,
            'image' => $imageName,

        ]);
        return redirect('/');
    }
}
