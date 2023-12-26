<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
