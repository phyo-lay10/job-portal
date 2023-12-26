<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Category;
use App\Models\Job;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $jobs = Job::where("employer_id", $user->id)->latest()->get();
        // $categories = Category::all();
        return view("admin.job.index", compact("jobs"));
        // return view("admin.job.index", compact("jobs", "categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.job.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        Job::create($data);
        return redirect()->route("jobs.index")->with("success", "You have successfully created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = Job::findOrfail($id);
        $categories = Category::all();
        return view("admin.job.edit", compact("job", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->validateRequest($request);
        Job::findOrFail($id)->update($data);
        return redirect()->route("jobs.index")->with("success", "You have successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Job::findOrFail($id)->delete();
        return back();
    }

    // Validation
    private function validateRequest(Request $request)
    {
        return $request->validate([
            "category_id" => "required",
            "employer_id" => "required",
            "title" => "required",
            "description" => "required",
            "salary" => "required|numeric",
        ]);
    }

    // get applications associate with a job
    public function getApplications($jobId)
    {
        $job = Job::find($jobId);
        return view("admin.job.application", compact("job"));
    }

    // public function acceptApplication(Request $request, $id)
    // {
    //     $application = Application::findOrFail($id);
    //     $application->update([
    //         "accept" => 1,
    //     ]);

    //     // $employeeId = $request->input('employeeId');
    //     Message::create([
    //         "employer_id" => Auth::user()->id,
    //         "employee_id" => $request->employeeId,
    //         "application_id" => $application->id,
    //         "job_id" => $request->jobId,
    //         "accept" => $application->accept,
    //         "message" => $request->message,
    //     ]);
    //     return back()->with("success", "The message has sent successfully!");
    // }

    // public function rejectApplication(Request $request, $id)
    // {
    //     $application = Application::findOrFail($id);
    //     $application->update([
    //         "accept" => 0,
    //     ]);


    //     // $employeeId = $request->input('employeeId');
    //     Message::create([
    //         "employer_id" => Auth::user()->id,
    //         "employee_id" => $request->employeeId,
    //         "job_id" => $request->jobId,
    //         "accept" => $application->accept,
    //         'application_id' => $request->applicationId,
    //         "message" => 'Sorry , better luck next time !',
    //     ]);
    //     // dd($request->employeeId);

    //     return back()->with("fail", "Application was rejected!");

    // }

    public function acceptApplication(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $application->update([
            "accept" => 1,
        ]);

        $message = Message::where('application_id', $application->id)->first();

        if ($message) {
            // If a message already exists, update it
            $message->update([
                "employer_id" => Auth::user()->id,
                "employee_id" => $request->employeeId,
                "job_id" => $request->jobId,
                "accept" => $application->accept,
                "message" => $request->message,
            ]);
        } else {
            // If no message exists, create a new one
            Message::create([
                "employer_id" => Auth::user()->id,
                "employee_id" => $request->employeeId,
                "application_id" => $application->id,
                "job_id" => $request->jobId,
                "accept" => $application->accept,
                "message" => $request->message,
            ]);
        }

        return back()->with("success", "The message has been sent successfully!");
    }

    public function rejectApplication(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $application->update([
            "accept" => 0,
        ]);

        $message = Message::where('application_id', $application->id)->first();

        if ($message) {
            // If a message already exists, update it
            $message->update([
                "employer_id" => Auth::user()->id,
                "employee_id" => $request->employeeId,
                "job_id" => $request->jobId,
                "accept" => $application->accept,
                "message" => 'Sorry, better luck next time!',
            ]);
        } else {
            // If no message exists, create a new one
            Message::create([
                "employer_id" => Auth::user()->id,
                "employee_id" => $request->employeeId,
                "application_id" => $application->id,
                "job_id" => $request->jobId,
                "accept" => $application->accept,
                "message" => 'Sorry, better luck next time!',
            ]);
        }

        return back()->with("fail", "Application was rejected!");
    }

    // private function accept(Request $request, $id) {
    //     return  [
    //         "employer_id" => Auth::user()->id,
    //         "employee_id" => $request->employeeId,
    //         "job_id" => $request->jobId,
    //         "accept" => $application->accept,
    //         "message" => $request->message,
    //     ]; 
    // }
}