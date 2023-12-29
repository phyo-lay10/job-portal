<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Comment;
use App\Models\News;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view("admin.dashboard");
    }
    public function payment()
    {
        return view("admin.payment.payment");
    }
    public function paymentStore(Request $request)
    {
        $request->validate([
            "image" => "required|image|mimes:jpg,png,jpeg",
        ]);

        $image = $request->image;
        $imageName = uniqid() . '_' . $image->getClientOriginalName();
        $image->storeAs("public/voucher-images", $imageName);

        Payment::create([
            "employer_id" => $request->employerId,
            "voucher_image" => $imageName,
        ]);

        return redirect()->route("payment");
    }
    public function userList()
    {
        $users = User::where("role", 'employer')->orWhere('role', 'admin')->get();
        return view("admin.user.index", compact("users"));
    }

    public function paymentDetail(Request $request, $employerId)
    {
        $payment = Payment::where('employer_id', $employerId)->first();
        $user = User::find($employerId);

        return view("admin.user.payment-info", compact("payment", "user"));
    }
    public function paymentConfirm(Request $request, $employerId)
    {
        $user = User::findOrFail($employerId);
        $user->update([
            'active' => 1
        ]);
        return back();
    }

    public function report()
    {
        // $mostCommentedNews = News::withCount('comments')
        //     ->orderBy('comments_count', 'desc')
        //     ->first();
        // dd($mostCommentedNews);
        $applicants = Application::where('accept', null)->with('employee')->get();
        $applicants = Application::all();
        $workers = Application::where('accept', 1)->get();
        $popularNews = News::has('comments', '>=', 3)->get();
        return view('admin.report.index', compact('applicants', 'workers', 'popularNews'));
    }

    // public function report(Request $request)
    // {
    //     $today = Carbon::now();

    //     if ($request->has('month') && $request->month === 'last') {
    //         $startOfMonth = $today->subMonth()->startOfMonth();
    //         $endOfMonth = $today->subMonth()->endOfMonth();
    //     } else {
    //         $startOfMonth = $today->startOfMonth();
    //         $endOfMonth = $today->endOfMonth();
    //     }

    //     $applicants = Application::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();
    //     $workers = Application::where('accept', 1)->whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();
    //     $popularNews = News::has('comments', '>=', 3)->whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();

    //     return view('admin.report.index', compact('applicants', 'workers', 'popularNews'));
    // }


}
