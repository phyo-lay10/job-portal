<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

// class AppController extends Controller
// {
//     public function app($id)
//     {
//         $apps = Application::where("job_id", $id)->get();

//         return view("admin.job.app", compact("apps"));
//     }

//     public function acceptApplication($appId)
//     {
//         dd($appId);

//         return redirect()->back()->with('success', 'Application accepted successfully.');
//     }

//     public function rejectApplication($appId)
//     {
//         dd($appId);

//         return redirect()->back()->with('success', 'Application rejected successfully.');
//     }
// }
