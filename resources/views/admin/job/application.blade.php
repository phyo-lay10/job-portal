@extends('admin.layouts.app')
@section('content')
  <div class="d-flex justify-content-between my-3">
    <div><h5 class="text-dark fw-bold">Application Lists</h5></div>
    <a href="{{url('admin/jobs')}}" class="btn btn-sm btn-info float-end mb-3 border-0" title="back"><i class="fa-solid fa-backward"></i></a>
  </div>
  @if($job->applications->isEmpty())
    <h6 class="fw-bold">No applications found for this job.</h6>
  @else

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span>{{session('success')}}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @elseif(session('fail'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span>{{session('fail')}}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
 
  <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Salary</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($job->applications as $app)
          <tr>
            <th>{{$app->id}}</th>
            <td>{{$app->name}}</td>
            <td>{{$app->email}}</td>
            <td>{{$app->phone}}</td>
            <td>{{$app->address}}</td>
            <td>$ {{$app->salary}}</td>
            <td>
                <form method="post"> @csrf
                  <input type="hidden" name="employerId" class="form-control " value="{{Auth::user()->id}}">
                  <input type="hidden" name="employeeId" class="form-control"  value="{{$app->employee_id}}"> 
                  <input type="hidden" name="jobId" class="form-control"  value="{{$app->job_id}}">
                  <input type="hidden" name="applicationId" class="form-control"  value="{{$app->id}}">
                  <button type="button" class="btn btn-sm btn-success 
                  @if($app) 
                      @if($app->accept == '1') d-none  @endif
                  @endif
                  "  id="acceptBtn{{$app->id}}"  data-bs-toggle="modal" data-bs-target="#exampleModal{{$app->id}}">
                    Accept
                  </button>
                  <button formaction="{{route('applications.reject', $app->id)}}" onclick="return confirm('Are u sure to reject?')" class="btn btn-sm btn-danger 
                    @if($app) 
                      @if($app->accept == '0') d-none  @endif
                    @endif
                  " onclick="return confirm('Are u sure to reject?')">Reject</button>
                </form>
            </td>
          </tr>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal{{$app->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title fs-5 text-dark" id="exampleModalLabel"><b>Cover Letter</b></h3>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post"> @csrf
                      <div class="mb-3">
                        <input type="hidden" name="employerId" class="form-control " value="{{Auth::user()->id}}">
                        <input type="hidden" name="employeeId" class="form-control"  value="{{$app->employee_id}}"> 
                        <input type="hidden" name="jobId" class="form-control"  value="{{$app->job_id}}"> 
                        <textarea name="message"  rows="5" class="form-control" required placeholder ="Message ... "></textarea>
                      </div>
                      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                      <button formaction="{{route('applications.accept', $app->id)}}" class="btn btn-sm btn-primary">Send</button>
                    </form>
                </div>
              </div>
            </div>
          </div>

        @endforeach
      </tbody>
  </table>
@endif
@endsection
