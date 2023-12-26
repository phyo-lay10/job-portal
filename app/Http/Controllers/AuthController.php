<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register()
    {
        return view("auth.register");
    }

    // public function registerStore(Request $request)
    // {
    //     $this->validateRequest($request);
    //     User::create([
    //         "name" => $request->name,
    //         "email" => $request->email,
    //         // "password" => $request->password,
    //         "password" => bcrypt($request->password),
    //     ]);
    //     return redirect()->route("loginForm")->with("success", "You have successfully registered!");
    // }

    public function registerStore(Request $request)
    {
        $this->validateRequest($request);

        // $active = $request->input('role') == 'employer' ? 0 : 1;
        $active = $request->role == 'employer' ? 0 : 1;
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role" => $request->role,
            "active" => $active,
        ]);

        return redirect()->route("loginForm")->with("success", "You have successfully registered!");
    }


    public function registerUpdate(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $user = auth()->user();

        if ($user->image) {
            Storage::delete('public/images/' . $user->image);
        }

        $image = $request->image;
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->storeAs('public/images', $imageName);

        $user = User::findOrFail($id);

        $user->update([
            "image" => $imageName,
        ]);

        return redirect()->route("profile")->with("success", "Photo has uploaded successfully!");

    }

    public function login()
    {
        $previousURL = url()->previous();
        $baseURL = url()->to("/");

        if ($previousURL != $baseURL . "/login") {
            session()->put("url.intended", $previousURL);
        }

        return view("auth.login");
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role == 'employer') {
                return redirect()->route('payment');
            } elseif ($user->role == 'admin') {
                return redirect()->route('userList');
            } else {
                // $intendedUrl = session()->pull('url.intended', '/');
                // return redirect()->to($intendedUrl);
                return redirect()->intended('/');
            }
        }

        return back()->with("error", "Email & password do not match our records !");
    }



    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('loginForm');
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
    }

}
